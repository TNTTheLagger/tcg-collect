<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Selection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
            color: #444;
        }

        form {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        form input[type="text"],
        form select,
        form button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        form button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }

        table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        th a {
            color: white;
            text-decoration: none;
        }

        th a:hover {
            text-decoration: underline;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        ul {
            padding-left: 20px;
        }

        @media (max-width: 768px) {
            table {
                width: 100%;
            }

            form {
                flex-direction: column;
                align-items: center;
            }

            form input[type="text"],
            form select,
            form button {
                width: 90%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <h1>Card Selection</h1>

    <form method="GET" action="{{ route('cards.index') }}">
        <input type="text" name="filter" placeholder="Search by name" value="{{ request('filter') }}">
        <select name="deck_id" onchange="this.form.submit()">
            <option value="">All Decks</option>
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
                    <td><a href="{{ route('cards.show', ['card_name' => $card->name]) }}">{{ $card->name }}</a></td>
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
