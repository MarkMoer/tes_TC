<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = DB::table('transactions')
            ->join('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
            ->select(
                'transactions.id',
                'transactions.no_transaction',
                'transactions.transaction_date',
                DB::raw('MIN(transactions.created_at) as earliest_created_at'),
                DB::raw('COUNT(transaction_details.id) as total_items'),
                DB::raw('SUM(transaction_details.quantity) as total_quantity')
            )
            ->groupBy('transactions.id', 'transactions.no_transaction', 'transactions.transaction_date')

            ->get();

        return view('transactions.index', compact('transactions'));
    }
    public function viewItems(Transaction $transaction)
    {
        $items = DB::table('transaction_details')
            ->where('transaction_id', $transaction->id)
            ->get();

        return view('transactions.view_items', compact('transaction', 'items'));
    }
    public function create()
    {
        return view('transactions.create');
    }
    public function store(Request $request)
    {
        // Validasi input jika diperlukan

        DB::beginTransaction();

        try {
            $transaction = DB::table('transactions')->insertGetId([
                'no_transaction' => $request->input('no_transaction'),
                'transaction_date' => $request->input('transaction_date'),
            ]);

            $items = $request->input('items');

            $itemData = [];
            foreach ($items as $item) {
                // Validasi data item jika diperlukan

                $itemData[] = [
                    'transaction_id' => $transaction,
                    'item' => $item['item'],
                    'quantity' => $item['quantity'],
                ];
            }

            DB::table('transaction_details')->insert($itemData);

            DB::commit();

            return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error creating transaction. Please try again.');
        }
    }

    public function editAllItems(Transaction $transaction)
    {
        $items = DB::table('transaction_details')->where('transaction_id', $transaction->id)->get();
        return view('transactions.edit_all_items', compact('transaction', 'items'));
    }

    public function updateAllItems(Request $request, Transaction $transaction)
    {
        // Validasi input jika diperlukan
        $request->validate([
            'items.*.item' => 'required|string',
            'items.*.quantity' => 'required|integer|min:0',
        ]);

        // Memperbarui setiap item
        foreach ($request->input('items', []) as $itemId => $itemData) {
            // Lakukan validasi tambahan jika diperlukan

            // Update data menggunakan Query Builder
            DB::table('transaction_details')
                ->where('transaction_id', $transaction->id)
                ->where('id', $itemId)
                ->update([
                    'item' => $itemData['item'],
                    'quantity' => $itemData['quantity'],
                ]);
        }

        return redirect()->route('transactions.index');
    }

    public function deleteItem(Transaction $transaction, $itemId)
    {
        // Lakukan validasi atau logika lainnya jika diperlukan

        // Hapus data menggunakan Query Builder
        DB::table('transaction_details')
            ->where('transaction_id', $transaction->id)
            ->where('id', $itemId)
            ->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
    public function delete(Transaction $transaction)
    {
        return view('transactions.delete', compact('transaction'));
    }


    public function destroy(Transaction $transaction)
    {
        // Hapus terlebih dahulu catatan anak di transaction_details
        DB::table('transaction_details')->where('transaction_id', $transaction->id)->delete();

        // Hapus transaksi
        DB::table('transactions')->where('id', $transaction->id)->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
