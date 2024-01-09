<!-- resources/views/transactions/create.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Transaction</title>
</head>

<body>
    <h1>Create Transaction</h1>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <label for="no_transaction">Transaction No:</label>
        <input type="text" name="no_transaction" required>
        <br>

        <label for="transaction_date">Transaction Date:</label>
        <input type="date" name="transaction_date" required>
        <br>

        <label>Items:</label>
        <div id="items">
            <div class="item">
                <input type="text" name="items[0][item]" placeholder="Item Name" required>
                <input type="number" name="items[0][quantity]" placeholder="Quantity" required>
                <button type="button" onclick="addItem()">Add Item</button>
            </div>
        </div>
        <br>

        <button type="submit">Create Transaction</button>
    </form>

    <script>
        let itemCount = 1;

        function addItem() {
            const itemsDiv = document.getElementById('items');
            const newItemDiv = document.createElement('div');
            newItemDiv.className = 'item';
            newItemDiv.innerHTML = `
                <input type="text" name="items[${itemCount}][item]" placeholder="Item Name" required>
                <input type="number" name="items[${itemCount}][quantity]" placeholder="Quantity" required>
            `;
            itemsDiv.appendChild(newItemDiv);
            itemCount++;
        }
    </script>
</body>

</html>
