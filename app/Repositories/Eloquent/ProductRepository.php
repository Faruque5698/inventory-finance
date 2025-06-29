<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function all(array $data = [])
    {
        $insertData = $this->model->query();
        if (isset($data['search'])){
            $insertData = $insertData->where('slug', 'like', '%'.$data['search'].'%')
                ->orWhere('name', 'like','%'.$data['search'].'%');
        }

        if (isset($data['status'])){
            $insertData = $insertData->where('status',$data['status']);
        }

        return $insertData->orderBy('id','DESC')->paginate(limit($data));
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function create(array $data)
    {
        $data = $this->model::create($data);
        return $data;
    }

    public function update(array $data, $id)
    {
        $product = $this->model::find($id);
        return $product->update($data);
    }

    public function delete($id)
    {
        return $this->model::find($id)->delete();
    }

    public function statusUpdate($status, $id)
    {
        return $this->model::find($id)->update([
            'status' => $status
        ]);
    }

    public function dropDownData()
    {
        return $this->model::select('id','name')->orderBy('name','ASC')->get();
    }


}
