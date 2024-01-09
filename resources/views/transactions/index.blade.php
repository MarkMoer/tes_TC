<!-- resources/views/transactions/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
</head>

<body>
    <h1>Transaction List</h1>
    <a href="{{ route('transactions.create') }}">Create New Transaction</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Transaction</th>
                <th>Total Items</th>
                <th>Total Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ $transaction->no_transaction }}</td>
                    <td>{{ $transaction->total_items }}</td>
                    <td>{{ $transaction->total_quantity }}</td>
                    <td>
                        <a href="{{ route('transactions.view_items', $transaction->id) }}">View</a>
                        <a href="{{ route('transactions.edit_all_items', $transaction->id) }}">Edit</a>
                        <a href="{{ route('transactions.delete', $transaction->id) }}"
                            onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No transactions found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
