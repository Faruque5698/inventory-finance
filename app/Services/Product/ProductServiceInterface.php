<?php

namespace App\Services\Product;

use Illuminate\Foundation\Http\FormRequest;

interface ProductServiceInterface
{
    public function getAllProduct(array $data);

    public function storeProduct(FormRequest $request);

    public function getProductById($id);

    public function updateProduct(FormRequest $request, $id);

    public function deleteProduct($id);

    public function statusUpdate($status, $id);

}
