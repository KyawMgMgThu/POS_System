<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelsPayment extends Model
{
    protected $fillable = [
        'amount',
        'order_id',
        'user_id'
    ];
}
