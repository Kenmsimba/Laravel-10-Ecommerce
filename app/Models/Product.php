<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category ()  //this product belongs to a certain category
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand ()    //this product belongs to a certain brand
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
