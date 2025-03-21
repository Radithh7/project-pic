<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nameproduct',
        'categories_id',
        'description',
        'stock',
        'price',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
}
