<?php

namespace EcoCredit\EcoCreditModule\Models;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    public $fillable = [
        'user_id',
        'type',
        'amount',
        'date',
    ];
}
