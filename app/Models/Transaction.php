<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function sales()
    {
        return $this->belongsToMany(\App\Models\Sale::class, 'transactions', 'ref', 'ref', 'ref', 'ref'); //How this code works, I don't know! But it works!
    }
}