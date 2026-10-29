<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->orderBy('transaction_date', 'desc')
            ->get();

        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $saldo = $totalIncome - $totalExpense;

        // Ambil 1 quote acak dari Database
        $quoteObj = Quote::inRandomOrder()->first();
        $randomQuote = $quoteObj ? $quoteObj->quote : "Sistem PRTS siap digunakan, Doktah.";

        return view('dashboard', compact('transactions', 'saldo', 'totalIncome', 'totalExpense', 'randomQuote'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create([
            'user_id' => auth()->id(),
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil dicatat ke PRTS!');
    }

    public function destroy(Transaction $transaction)
    {
        // Keamanan: Cuma pemilik transaksi yang bisa hapus
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus!');
    }
}
