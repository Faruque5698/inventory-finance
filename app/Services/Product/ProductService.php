<?php

namespace App\Services\Product;

use App\Helpers\Classes\FileManage;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Traits\ProductTrait;
use Illuminate\Foundation\Http\FormRequest;

class ProductService implements ProductServiceInterface
{
    use ProductTrait;
    protected $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProduct(array $data)
    {
        return $this->productRepository->all($data);
    }

    public function storeProduct(FormRequest $request)
    {
        $data = $this->processData($request,'create');
        $data['image'] = $this->imageProcess($request->file('image'));
        return $this->productRepository->create($data);

    }

    public function getProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function updateProduct(FormRequest $request, $id)
    {
        $data = $this->processData($request,'update');
        $singleData = $this->productRepository->find($id);
        if ($request->hasFile('image')) {
            $data['image'] = $this->imageProcess($request->file('image'), $singleData);
        }
        return $this->productRepository->update($data, $id);
    }

    public function deleteProduct($id)
    {
        $data = $this->productRepository->find($id);
        if ($data && $data->image){
            FileManage::fileDelete($data->image);
        }
        return $this->productRepository->delete($id);

    }

    public function statusUpdate($status, $id)
    {
       return $this->productRepository->statusUpdate($status, $id);
    }

    public function productDropDown()
    {
        return $this->productRepository->dropDownData();
    }
}
