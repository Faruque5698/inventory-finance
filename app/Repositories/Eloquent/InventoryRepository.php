<?php

namespace App\Repositories\Eloquent;

use App\Models\Inventory;
use App\Repositories\Contracts\InventoryRepositoryInterface;

class InventoryRepository implements InventoryRepositoryInterface
{
    protected $model;
    public function __construct(Inventory $model)
    {
        $this->model = $model;
    }

    public function all(array $data = [])
    {
        $insertData = $this->model::with(['product' => function ($q) {
            $q->select('id','name','slug');
        }])->select(
          'id',
            'product_id',
            'code',
            'total_quantity',
            'current_quantity',
            'created_at',
            'updated_at'
        );

        if (isset($data['product_id'])){
            $insertData =  $insertData->where('product_id',$data['product_id']);
        }

        return $insertData->paginate(limit($data));

    }

    public function find($id)
    {
        return $this->model::with('product')->find($id);
    }

    public function create(array $data)
    {
        $data = $this->model::create($data);
        return $data;
    }

    public function update(array $data, $id)
    {
        $inventory = $this->model::find($id);
        return $inventory->update($data);
    }

    public function delete($id)
    {
        return $this->model::find($id)->delete();
    }

    public function inventoryCheckByProduct($product_id)
    {
       return $this->model::where('product_id',$product_id)->first();
    }


}
