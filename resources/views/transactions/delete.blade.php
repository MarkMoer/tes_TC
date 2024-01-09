<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Transaction</title>
</head>

<body>
    <h1>Delete Transaction {{ $transaction->no_transaction }}</h1>

    <p>Are you sure you want to delete this transaction?</p>
    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit">Yes, Delete</button>
    </form>

    <a href="{{ route('transactions.index') }}">Cancel</a>
</body>

</html>
