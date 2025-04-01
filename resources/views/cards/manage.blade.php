<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cards</title>
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

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select,
        button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .properties {
            margin-top: 20px;
        }

        .property {
            display: flex;
            gap: 10px;
        }

        .property input {
            flex: 1;
        }

        .add-property {
            margin-top: 10px;
            background-color: #28a745;
        }

        .add-property:hover {
            background-color: #218838;
        }

        .remove-property {
            background-color: #dc3545;
            color: white;
            border: none;
            cursor: pointer;
        }

        .remove-property:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Manage Cards</h1>

        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <form method="POST" action="{{ route('cards.store') }}">
            @csrf
            <label for="deck_id">Deck</label>
            <select name="deck_id" id="deck_id" required>
                <option value="">Select a Deck</option>
                @foreach ($decks as $deck)
                    <option value="{{ $deck->id }}">{{ $deck->name }}</option>
                @endforeach
            </select>

            <label for="name">Card Name</label>
            <input type="text" name="name" id="name" placeholder="Enter card name" required>

            <div class="properties">
                <label>Properties</label>
                <div id="properties-container">
                    <div class="property">
                        <input type="text" name="properties[0][name]" placeholder="Property Name" required>
                        <input type="text" name="properties[0][value]" placeholder="Property Value" required>
                        <button type="button" class="remove-property" onclick="removeProperty(this)">Remove</button>
                    </div>
                </div>
                <button type="button" class="add-property" onclick="addProperty()">Add Property</button>
            </div>

            <button type="submit">Save Card</button>
        </form>
    </div>

    <script>
        let propertyIndex = 1;

        function addProperty() {
            const container = document.getElementById('properties-container');
            const propertyDiv = document.createElement('div');
            propertyDiv.classList.add('property');
            propertyDiv.innerHTML = `
                <input type="text" name="properties[${propertyIndex}][name]" placeholder="Property Name" required>
                <input type="text" name="properties[${propertyIndex}][value]" placeholder="Property Value" required>
                <button type="button" class="remove-property" onclick="removeProperty(this)">Remove</button>
            `;
            container.appendChild(propertyDiv);
            propertyIndex++;
        }

        function removeProperty(button) {
            button.parentElement.remove();
        }
    </script>
</body>

</html>
