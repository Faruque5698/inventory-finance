<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Services\Product\ProductServiceInterface;
use App\Services\Sale\SaleServiceInterface;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    protected $saleService;
    protected $productService;
    public function __construct(SaleServiceInterface $saleService, ProductServiceInterface $productService)
    {
        $this->saleService = $saleService;
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sales = $this->saleService->getAllData($request->all());
        return view('backend.pages.Sale.list',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = $this->productService->productDropDown();
        return view('backend.pages.Sale.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaleRequest $request)
    {
        $this->saleService->storeData($request);
        Toastr::success('Sales created successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('sales.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = $this->saleService->getDataById($id);
        return view('backend.pages.Sale.view',compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaleRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->saleService->deleteData($id);
        Toastr::success('Sales deleted successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('sales.index');
    }
}
