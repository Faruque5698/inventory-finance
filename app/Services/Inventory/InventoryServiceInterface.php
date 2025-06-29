<?php

namespace App\Services\Inventory;

use Illuminate\Foundation\Http\FormRequest;

interface InventoryServiceInterface
{
    public function getAllData(array $data);

    public function storeData(FormRequest $request);

    public function getDataById($id);

    public function updateData(FormRequest $request, $id);

    public function deleteData($id);

}
