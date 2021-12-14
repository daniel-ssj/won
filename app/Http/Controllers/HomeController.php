<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $accounts = Account::all()->where('user_id', Auth::user()->id);
        $balances = [];
        $transactions = [];

        foreach($accounts as $account) {
            array_push($balances, $account->balance);
            array_push($transactions, $account->transactions()->latest()->get());
        }

        $total_balance = array_sum($balances);

        $expenses = [];
        $income = [];

        $_transactions = [];

        foreach($transactions as $transaction) {
            foreach($transaction as $t) {
                array_push($_transactions, $t);

                if (!$t->isIncome) {
                    array_push($expenses, $t->amount);
                } else {
                    array_push($income, $t->amount); 
                }
            }
        }
        
        $total_expenses = array_sum($expenses);
        $total_income = array_sum($income);
        $cash_flow = $total_income - $total_expenses;

        $_transactions = array_slice($_transactions, 0, 5);

        $spending_by_categories = [];

        foreach($accounts as $account) {
            array_push($spending_by_categories, Transactions::selectRaw('category, sum(amount) as amount')->where('account_id', $account->id)
                ->where('isIncome', '=', '0')->groupBy('category')->get());
        }

        return view('index', compact('accounts', 'total_balance', 'total_expenses', 'total_income', 'cash_flow', '_transactions', 'spending_by_categories'));
    }
}
