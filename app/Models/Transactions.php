<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'transaction_type',
        'status',
        'wallet_id'
    ];

    public function wallet()
    {
        return $this->belongsTo('App\Wallet');
    }

}
