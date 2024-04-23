<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function additions()
    {
        return $this->hasMany(ProductAdditionalField::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('created_at', 'desc');
    }
}
