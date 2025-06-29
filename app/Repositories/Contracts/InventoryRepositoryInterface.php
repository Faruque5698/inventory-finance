<?php

namespace App\Repositories\Contracts;

interface InventoryRepositoryInterface extends RepositoryInterface
{
    public function inventoryCheckByProduct($product_id);
}
