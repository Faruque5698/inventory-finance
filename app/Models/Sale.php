<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $guarded = [];
    public function items()
    {
        return $this->hasOne(SaleItem::class)
            ->join('products','sale_items.product_id','products.id')
            ->select(
                'sale_items.id',
                'sale_items.sale_id',
                'sale_items.product_id',
                'products.name',
                'products.slug'
            );
    }
}
