<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'body',
    ];
    // protected $appends = ['name'];
    // public function user()
    // {
    // 	return $this->belongsTo(User::class);
    // }

    // public function getNameAttribute(){
    //     $name = $this->user->name;
    //     return $name;
    // }
}
