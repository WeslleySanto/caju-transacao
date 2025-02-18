<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['accountId', 'amount', 'mcc', 'merchant'];
}
