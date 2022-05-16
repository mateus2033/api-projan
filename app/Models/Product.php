<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','price','validate','category_id','brand_id'];
    use HasFactory;


    public function category()
    {
        return $this->hasMany(Category::class, 'id', 'category_id');
    }

    public function brand()
    {
        return $this->hasMany(Brand::class,'id','brand_id');
    }

}
