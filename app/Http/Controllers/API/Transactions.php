<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Transactions;
use Validator;

class Transactions extends Controller
{
    public function store(Request $request)
    {
       
        $data = ['transaction_type'  =>  'credit',
                'amount' => $request->amount,
                'status' => 1,
                'wallet_id'
                ];
        $wallet = Transactions::create($data);
        return $wallet;
    }

    public function withdraw(Request $request)
    {
        $data = ['transaction_type'  =>  'debit',
                  'amount' => $request->amount,
                  'status' => 1,
                  'wallet_id'
                ];
        $wallet = Transactions::create($data);
        return $wallet;
    }
}
