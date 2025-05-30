<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   protected $fillable = [
        'name',
        'type',
        'presentation',
        'cost_price',
        'sale_price',
        'stock',
        'min_stock'
    ];
}
