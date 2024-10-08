<?php

namespace TadgKeatingWebb\EcoCreditModule\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $fillable = [
        'user_id',
        'type',
        'amount',
        'date',
        'transaction_type',
    ];
}
