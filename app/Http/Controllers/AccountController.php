<?php

namespace App\Http\Controllers;

use App\Models\Account;
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
        $transactions = $account->transactions;

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
}
