<?php

namespace App\Traits;

use Illuminate\Foundation\Http\FormRequest;

trait InventoryTrait
{
    public function processData(FormRequest $request, $method = 'create')
    {
        $data['product_id'] = $request->product_id;
        $data['total_quantity'] = $request->total_quantity;
        $data['current_quantity'] = $request->current_quantity;
        if ($method == 'create'){
            $data['code'] = generateSequentialUniqueCode('inv','inventories','code','5');
        }

        return $data;
    }
}
