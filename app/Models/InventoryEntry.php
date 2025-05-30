<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryEntry extends Model
{
   protected $fillable = ['product_id',
    'quantity',
    'cost',
    'entry_date',
    'note',];
    
public function product()
{
    return $this->belongsTo(Product::class);
}
}
