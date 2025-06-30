<?php

namespace App\Repositories\Eloquent;

use App\Models\Sale;
use App\Repositories\Contracts\SaleRepositoryInterface;

class SaleRepository implements SaleRepositoryInterface
{
    protected $model;
    public function __construct(Sale $model)
    {
        $this->model = $model;
    }

    public function all(array $data = [])
    {
        $insertData = $this->model::query();
        if (isset($data['search'])){
            $insertData =  $insertData->where('invoice_no','like', '%'.$data['search'].'%');
        }
        return $insertData->paginate(limit($data));

    }

    public function find($id)
    {
        return $this->model::with('items')->find($id);
    }

    public function create(array $data)
    {
        $data = $this->model::create($data);
        return $data;
    }

    public function update(array $data, $id)
    {

    }

    public function delete($id)
    {
        $data = $this->model::find($id);
        $data->items()->delete();
        $data->delete();
        return true;

    }

}
