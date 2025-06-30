<?php

namespace App\Services\Sale;

use Illuminate\Foundation\Http\FormRequest;

interface SaleServiceInterface
{
    public function getAllData(array $data);

    public function storeData(FormRequest $request);

    public function getDataById($id);

    public function deleteData($id);

}
