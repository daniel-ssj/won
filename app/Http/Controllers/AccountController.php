<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AccountController extends Controller
{
    public function listAccounts() {
        $accounts = Account::all()->where('user_id', Auth::user()->id);

        return view('accounts.index', compact('accounts'));
    }

    public function accountDetail($id) {
        $account = Account::all()->find($id);
        $transactions = $account->transactions()->latest()->paginate(8);

        return view('accounts.detail', compact('account', 'transactions'));
    }

    public function addAccount(Request $request) {
        $validatedData = $request->validate([
            'account_name' => 'required|max:191',
            'balance_amount' => 'required|integer|min:0'
        ], [
            'account_name.required' => 'Nome da conta não pode ser vazio',
            'account_name.max' => 'Nome da conta não pode exceder 191 caracteres'
        ]);

        Account::insert([
            'name' => $request->account_name,
            'balance' => $request->balance_amount,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Account created succesfully');
    }

    public function addTransaction(Request $request, $id) {
        $isIncome = $request->query('inc');
        return view('accounts.add-transaction', compact('id', 'isIncome'));
    }

    public function addTransactionDone(Request $request) {
        $validatedData = $request->validate([
            'category' => 'required|max:191',
            'amount' => 'required|integer|min:0'
        ], [
            'account_name.required' => 'Categoria não pode ser vazio',
            'account_name.max' => 'Nome da conta não pode exceder 191 caracteres'
        ]);

        Transactions::insert([
            'category' => $request->category,
            'amount' => $request->amount,
            'account_id' => $request->account_id,
            'isIncome' => $request->is_income,
            'created_at' => Carbon::now()
        ]);

        $account = Account::find($request->account_id);
        $currentBalance = $account->balance;

        if($request->is_income == 1) {
            $account->update([
                'balance' => $currentBalance + $request->amount
            ]);
        } else {
            $account->update([
                'balance' => $currentBalance - $request->amount
            ]);
        }

        return Redirect()->route('accountDetail', $request->account_id)->with('success', 'Transação inserida com sucesso');
    }
}
