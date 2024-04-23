<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductAdditionalField;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ImportToDBService
{
    public mixed $query_product;
    public mixed $query_additional_fields;
    public function __construct()
    {
        $this->query_product = Product::query();
        $this->query_additional_fields = ProductAdditionalField::query();
    }

    public function import($data):void
    {
        foreach ($data as $items) {
            foreach($items as $item)
            {
                $this->queryToDB($item);
            }
        }
    }

    public function queryToDB($item):void
    {
        try {
            DB::beginTransaction();
            $cena_cena_prodazi = floatval($item['cena_cena_prodazi']);
            $zakupocnaia_cena = floatval($item['zakupocnaia_cena']);
            $discount = round((($cena_cena_prodazi - $zakupocnaia_cena) / $cena_cena_prodazi) * 100, 2);

            $product = $this->query_product->create([
                'name' => $item['naimenovanie'],
                'description' => $item['opisanie'],
                'price' => $cena_cena_prodazi,
                'discount' => $discount,
                'external_code' => $item['vnesnii_kod'],
            ]);
            $dop_pole_items = collect($item)->filter(function ($value, $key) {
                return Str::startsWith($key, 'dop_pole_');
            })->mapWithKeys(function ($value, $key) {
                return [Str::after($key, 'dop_pole_') => $value];  // Удаление префикса из ключа
            })->all();

            foreach ($dop_pole_items as $key => $value) {
                if($value)
                {
                    $this->query_additional_fields->create([
                        'product_id' => $product->id,
                        'key' => $key,
                        'value' => $value,
                    ]);
                }

            }

            DB::commit();
        }
        catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
