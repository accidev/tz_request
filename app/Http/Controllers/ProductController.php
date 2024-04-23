<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
class ProductController extends Controller
{

    public ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function importPage(): View
    {
        return view('import_products');
    }

    public function uploadExcel(Request $request): RedirectResponse
    {
        $file = $request->file('file');
        $this->productService->uploadExel($file);
        return redirect()->route('index');
    }

    public function show(Product $product): View
    {
        return view('product_show', compact('product'));
    }

    public function uploadImage(UploadImageRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $this->productService->uploadImage($data['image'], $product);
        return back();
    }
}
