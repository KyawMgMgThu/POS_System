<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelsTransaction extends Model
{
    protected $fillable = [
        'cart_id', 'paid_amount', 'balance', 'transac_date', 'transac_amount', 'user_id', 'payment_method'
    ];
}
