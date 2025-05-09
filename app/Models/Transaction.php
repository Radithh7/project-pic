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
        'status',
        'payment_method', 
        'order_id',       
        'snap_token'      
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
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
