<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TGC-COLLECT</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Welcome to TGC-COLLECT</h1>

    <form method="GET" action="{{ route('cards.index') }}">
        <input type="text" name="filter" placeholder="Search by name" value="{{ request('filter') }}">
        <select name="deck_id" onchange="this.form.submit()">
            <option value="">All Decks</option> <!-- Ensure All Decks option works -->
            @foreach ($decks as $deck)
                <option value="{{ $deck->id }}" {{ request('deck_id') == $deck->id ? 'selected' : '' }}>
                    {{ $deck->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Search</button>
    </form>

    @if (request('deck_id'))
        <p style="text-align: center;"><strong>Deck Description:</strong>
            {{ $decks->firstWhere('id', request('deck_id'))->description ?? 'No Description' }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>
                    <a
                        href="{{ route('cards.index', array_merge(request()->all(), ['sort_by' => 'name', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Name
                    </a>
                </th>
                <th>
                    <a
                        href="{{ route('cards.index', array_merge(request()->all(), ['sort_by' => 'deck', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}">
                        Deck
                    </a>
                </th>
                <th>Properties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cards as $card)
                <tr>
                    <td>{{ $card->name }}</td>
                    <td>{{ $card->deck->name ?? 'No Deck' }}</td>
                    <td>
                        <ul>
                            @if ($card->properties && $card->properties->isNotEmpty())
                                @foreach ($card->properties as $property)
                                    <li>{{ $property->name }}: {{ $property->value }}</li>
                                @endforeach
                            @else
                                <li>No Properties</li>
                            @endif
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
