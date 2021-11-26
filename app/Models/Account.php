<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function transactions() {
        return $this->hasMany(Transactions::class, 'account_id', 'id');
    }
}
