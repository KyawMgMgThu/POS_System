<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelsOrderItem extends Model
{
    protected $fillable = [
        'price',
        'quantity',
        'product_id',
        'models_order_id',
    ];
    public function product()
    {
        return $this->belongsTo(ModelsProduct::class);
    }

    public function order()
    {
        return $this->belongsTo(ModelsOrder::class);
    }
}
