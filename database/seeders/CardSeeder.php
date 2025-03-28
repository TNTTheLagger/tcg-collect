<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cards = [];
        for ($deckId = 1; $deckId <= 100; $deckId++) {
            for ($i = 1; $i <= 5; $i++) { // Ensure at least 5 cards per deck
                $cards[] = [
                    'name'    => "Card $deckId-$i",
                    'deck_id' => $deckId,
                ];
            }
        }

        DB::table('cards')->insert($cards);
    }
}
