<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{

    public function showDeposits()
    {
        $deposits = Transaction::where('user_id', Auth::id())
            ->where('transaction_type', 'deposit')
            ->get();
        
        return view('transactions.deposits', compact('deposits'));
    }

    public function showDepositForm()
    {
        return view('transactions.deposit');
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $transaction = new Transaction([
            'transaction_type' => 'deposit',
            'amount' => $request->amount,
            'fee' => 0,
            'date' => Carbon::now()->toDateString(),
        ]);
        $user->transactions()->save($transaction);

        $user->balance += $request->amount;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Deposit successful');
    }

    public function showWithdrawals()
    {
        $withdrawals = Transaction::where('user_id', Auth::id())->where('transaction_type', 'withdrawal')->get();
        return view('transactions.withdrawals', compact('withdrawals'));
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $user = Auth::user();
        $amount = $request->amount;
        $fee = $this->calculateFee($user, $amount);

        if ($user->balance < ($amount + $fee)) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        $transaction = new Transaction([
            'transaction_type' => 'withdrawal',
            'amount' => $amount,
            'fee' => $fee,
            'date' => Carbon::now()->toDateString(),
        ]);
        $user->transactions()->save($transaction);

        $user->balance -= ($amount + $fee);
        $user->save();

        return response()->json($transaction, 201);
    }

    private function calculateFee($user, $amount)
    {
        $fee = 0;

        if ($user->account_type == 'Individual') {
            $today = Carbon::today();
            $firstOfMonth = $today->copy()->startOfMonth();
            $friday = $today->isFriday();
            $monthlyWithdrawals = $user->transactions()
                ->where('transaction_type', 'withdrawal')
                ->whereBetween('date', [$firstOfMonth, $today])
                ->sum('amount');

            if ($friday || $monthlyWithdrawals + $amount <= 5000 || $amount <= 1000) {
                return 0;
            }

            $fee += ($amount - 1000) * 0.00015;
            if ($monthlyWithdrawals + $amount > 5000) {
                $fee += ($amount - 5000) * 0.00015;
            }
        } else {
            $totalWithdrawals = $user->transactions()
                ->where('transaction_type', 'withdrawal')
                ->sum('amount');

            if ($totalWithdrawals + $amount > 50000) {
                $fee = $amount * 0.00015;
            } else {
                $fee = $amount * 0.00025;
            }
        }

        return $fee;
    }
}

