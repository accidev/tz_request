<?php

namespace App\Services;

use App\Imports\ExcelDataImport;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ProductService
{
    public ImportToDBService $importToDBService;

    public function __construct(ImportToDBService $importToDBService)
    {
        $this->importToDBService = $importToDBService;
    }

    public function uploadExel(UploadedFile $file):void
    {
        $data = Excel::toCollection(new ExcelDataImport, $file);
        $this->importToDBService->import($data);
    }

    public function uploadImage(UploadedFile $file, Product $product):void
    {
        $file_path = Storage::disk('public')->putFile('products', $file);
        ProductImage::query()->create([
            'image' => $file_path,
            'product_id' => $product->id
        ]);
    }
}
