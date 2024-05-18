<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelsOrder extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id'
    ];

    public function items()
    {
        return $this->hasMany(ModelsOrderItem::class);
    }

    public function payments()
    {
        return $this->hasMany(ModelsPayment::class);
    }
}
