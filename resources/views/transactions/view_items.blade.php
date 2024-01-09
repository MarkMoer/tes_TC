<!-- resources/views/transactions/view_items.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items in Transaction</title>
</head>

<body>
    <h1>Items in Transaction {{ $transaction->no_transaction }}</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Item</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->item }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No items found for this transaction</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
