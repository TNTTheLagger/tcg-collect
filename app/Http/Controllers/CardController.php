<?php
namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $query = Card::with(['properties', 'deck']); // Ensure relationships are eagerly loaded

        if ($request->has('sort_by')) {
            if ($request->get('sort_by') === 'deck') {
                $query->join('decks', 'cards.deck_id', '=', 'decks.id')
                    ->select('cards.*', 'decks.name as deck_name')
                    ->orderBy('decks.name', $request->get('order', 'asc'));
            } else {
                $query->orderBy($request->get('sort_by'), $request->get('order', 'asc'));
            }
        }

        if ($request->has('filter')) {
            $query->where('cards.name', 'like', '%' . $request->get('filter') . '%'); // Explicitly reference cards.name
        }

        if ($request->filled('deck_id')) { // Only filter by deck_id if it is provided
            $query->where('deck_id', $request->get('deck_id'));
        }

        $cards = $query->get() ?? collect(); // Ensure $cards is always a collection
        $decks = \App\Models\Deck::all();    // Fetch all decks for the dropdown

        return view($request->route()->getName() === 'home' ? 'welcome' : 'cards.index', compact('cards', 'decks'));
    }

    public function show(string $card_name)
    {
        $card = Card::with(['properties', 'deck'])->where('name', $card_name)->firstOrFail();

        return view('cards.show', compact('card'));
    }

    public function manage()
    {
        $decks = \App\Models\Deck::all();
        return view('cards.manage', compact('decks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'deck_id'            => 'required|exists:decks,id',
            'name'               => 'required|string|max:255',
            'properties'         => 'array',
            'properties.*.name'  => 'required|string|max:255',
            'properties.*.value' => 'required|string|max:255',
        ]);

        $card = \App\Models\Card::updateOrCreate(
            ['name' => $validated['name']],
            ['deck_id' => $validated['deck_id']]
        );

        if (isset($validated['properties'])) {
            $card->properties()->delete(); // Clear existing properties
            foreach ($validated['properties'] as $property) {
                $card->properties()->create($property);
            }
        }

        return redirect()->route('cards.manage')->with('success', 'Card saved successfully!');
    }
}
