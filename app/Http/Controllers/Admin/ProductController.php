<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\Product\ProductServiceInterface;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected  $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->productService->getAllProduct($request->all());
        return view('backend.pages.product.list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->storeProduct($request);
        Toastr::success('Product store successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->getProductById($id);
        return view('backend.pages.product.view',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productService->getProductById($id);
        return view('backend.pages.product.update', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $this->productService->updateProduct($request, $id);
        Toastr::success('Product update successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productService->deleteProduct($id);
        Toastr::success('Product delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('products.index');
    }

    /**
     * Status update
     */
    public function statusUpdate(Request $request, string $id)
    {
        $this->productService->statusUpdate($request->status, $id);
        Toastr::success('Product status update successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('products.index');
    }
}
