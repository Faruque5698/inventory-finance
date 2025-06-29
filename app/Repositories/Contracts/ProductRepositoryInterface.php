<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function statusUpdate($status, $id);

    public function dropDownData();
}
