<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Transactions;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Validator;

class TransactionsController extends BaseController
{
    public function credit(Request $request)
    {
      $wallet = Wallet::where('id', '=', Auth::id())->first();
      $data = [
            'transaction_type' => 'deposit',
            'amount' => $request->amount,
            'wallet_id' => $request->wallet_id,
            'status' => 1,
                ];
      $result = Transactions::create($data);
      $wallet->increment('balance', $request->amount);
      return $result;
    }

    public function withdrawal(Request $request)
    {
      $wallet = Wallet::where('id', '=', Auth::id())->first();
        $data = [
            'transaction_type' => 'withdrawal',
            'amount' => $request->amount,
            'wallet_id' => $request->wallet_id,
            'status' => 1,
                  ];
        $result = Transactions::create($data);
        $wallet->decrement('balance', $request->amount);
        return $result;
    }
}
