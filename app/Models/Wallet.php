<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'balance',
        'debit',
        'credit'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transactions');
    }

}
