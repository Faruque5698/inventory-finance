<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryRequest;
use App\Services\Inventory\InventoryServiceInterface;
use App\Services\Product\ProductServiceInterface;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    protected $inventoryService;
    protected $productService;
    public function __construct(InventoryServiceInterface $inventoryService, ProductServiceInterface $productService)
    {
        $this->inventoryService = $inventoryService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $inventories = $this->inventoryService->getAllData($request->all());
        $products = $this->productService->productDropDown();
        return view('backend.pages.inventory.list',compact('inventories','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = $this->productService->productDropDown();
        return view('backend.pages.inventory.create',compact('products'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryRequest $request)
    {
        $data = $this->inventoryService->storeData($request);
        if ($data){
            Toastr::success('Inventory created successfully', 'Success', ["positionClass" => "toast-top-right"]);
        }else{
            Toastr::warning('This product already has inventory, please update it.', 'Warning', ["positionClass" => "toast-top-right"]);

        }
        return redirect()->route('inventories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inventory = $this->inventoryService->getDataById($id);
        return view('backend.pages.inventory.view',compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inventory = $this->inventoryService->getDataById($id);
        $products = $this->productService->productDropDown();
        return view('backend.pages.inventory.update',compact('inventory', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InventoryRequest $request, string $id)
    {
        $this->inventoryService->updateData($request, $id);
        Toastr::success('Inventory update successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('inventories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->inventoryService->deleteData($id);
        Toastr::success('Inventory delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('inventories.index');
    }
}
