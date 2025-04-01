<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $card->name }} - Card Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #444;
        }

        ul {
            padding-left: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-link {
            display: block;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="{{ route('cards.index') }}" class="back-link">&larr; Back to Card Selection</a>
        <h1>{{ $card->name }}</h1>
        <p><strong>Deck:</strong> {{ $card->deck->name ?? 'No Deck' }}</p>
        <p><strong>Properties:</strong></p>
        <ul>
            @if ($card->properties && $card->properties->isNotEmpty())
                @foreach ($card->properties as $property)
                    <li>{{ $property->name }}: {{ $property->value }}</li>
                @endforeach
            @else
                <li>No Properties</li>
            @endif
        </ul>
    </div>
</body>

</html>
