<!-- resources/views/transactions/edit_all_items.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit All Items in Transaction</title>
</head>

<body>
    <h1>Edit All Items in Transaction {{ $transaction->no_transaction }}</h1>

    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form action="{{ route('transactions.update_all_items', $transaction->id) }}" method="POST">
        @csrf
        @method('PUT')

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><input type="text" name="items[{{ $item->id }}][item]" value="{{ $item->item }}"
                                required></td>
                        <td><input type="number" name="items[{{ $item->id }}][quantity]"
                                value="{{ $item->quantity }}" required></td>
                        <td>
                            <form
                                action="{{ route('transactions.delete_item', ['transaction' => $transaction->id, 'item' => $item->id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No items found for this transaction</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <button type="submit">Update All Items</button>
    </form>

</body>

</html>
