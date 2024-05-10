<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelsCartDetail extends Model
{
    protected $fillable = [
        'cart_id', 'product_id', 'unitprice', 'quantity', 'amount', 'discount'
    ];
}
