<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\Wallet;
use Validator;

class TransactionsController extends Controller
{
    public function credit(Request $request)
    {
      // $wallet = Wallet::where('id', '=', $request->user_id)->first();
      // if ($wallet->balance < 1) {
      //   return ('insufficient fund');
      // }
      $data = ['transaction_type' => 'deposit',
                'amount' => $request->amount,
                'wallet_id' => $request->wallet_id,
                'status' => 1,
                ];
      $result = Transactions::create($data);
      // $wallet->balance->increment('balance', $request->amount);
      return $result;
    }

    // public function withdrawal(Request $request)
    // {
    //   $wallet = Wallet::where('id', '=', Auth::id())->first();
    //     $data =  ['transaction_type'  =>  => $request->credit,,
    //               'amount' => $request->amount,
    //               'wallet_id' => auth()->user()->wallet()->id,
    //               'wallet_id' => $request->wallet_id,
    //               ];
    //     $wallet->balance->decrement('balance', $request->amount);
    //     $wallet->save();
    //     $wallet = Transactions::create($data);
    //     return $wallet;
    // }
}
