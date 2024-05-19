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

    public function customer()
    {
        return $this->belongsTo(ModelsCustomer::class);
    }
    public function getcustomerName()
    {
        if ($this->customer) {
            return $this->customer->first_name . ' ' . $this->customer->last_name;
        }
        return 'Unknown';
    }
    public function total()
    {
        return $this->items->map(function ($item) {
            return $item->price;
        })->sum();
    }

    public function formattedTotal()
    {
        return number_format($this->total(), 2);
    }

    public function receivedAmount()
    {
        return $this->payments->map(function ($i) {
            return $i->amount;
        })->sum();
    }

    public function formattedReceivedAmount()
    {
        return number_format($this->receivedAmount(), 2);
    }
}
