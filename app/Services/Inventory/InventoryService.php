<?php

namespace App\Services\Inventory;

use App\Repositories\Contracts\InventoryRepositoryInterface;
use App\Traits\InventoryTrait;
use Illuminate\Foundation\Http\FormRequest;

class InventoryService implements InventoryServiceInterface
{
    use InventoryTrait;
    protected $inventoryRepository;
    public function __construct(InventoryRepositoryInterface $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    public function getAllData(array $data)
    {
        return $this->inventoryRepository->all($data);
    }

    public function storeData(FormRequest $request)
    {
        $inventoryData = $this->inventoryRepository->inventoryCheckByProduct($request->product_id);
        if ($inventoryData){
            return false;
        }
        $data = $this->processData($request);
        return $this->inventoryRepository->create($data);
    }

    public function getDataById($id)
    {
        return $this->inventoryRepository->find($id);
    }

    public function updateData(FormRequest $request, $id)
    {
        $data = $this->processData($request,'update');
        return $this->inventoryRepository->update($data, $id);
    }

    public function deleteData($id)
    {
        return $this->inventoryRepository->delete($id);
    }

}
