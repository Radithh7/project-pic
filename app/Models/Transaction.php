<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_date',
        'buyer_name',
        'total',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_items')
            ->withPivot('quantity', 'price', 'subtotal')
            ->withTimestamps();
    }
}
