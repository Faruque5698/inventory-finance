<?php

namespace App\Services\Sale;

use App\Models\SaleItem;
use App\Repositories\Contracts\SaleRepositoryInterface;
use App\Traits\SaleTrait;
use Illuminate\Foundation\Http\FormRequest;

class SaleService implements SaleServiceInterface
{
    use SaleTrait;
    protected $saleRepository;
    public function __construct(SaleRepositoryInterface $saleRepository)
    {
        $this->saleRepository = $saleRepository;
    }

    public function getAllData(array $data)
    {
        return $this->saleRepository->all($data);
    }

    public function storeData(FormRequest $request)
    {
        $data = $this->processData($request);
        $insertData = $this->saleRepository->create($data);
        if ($insertData){
            SaleItem::insert([
                'product_id' => $request->product_id,
                'sale_id' => $insertData->id,
                'created_at' => now(),
            ]);
        }

        return $insertData;
    }

    public function getDataById($id)
    {
        return $this->saleRepository->find($id);
    }

    public function deleteData($id)
    {
        return $this->saleRepository->delete($id);
    }

}
