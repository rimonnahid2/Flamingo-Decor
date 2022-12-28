<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;
use App\Models\Admin\Product;

class Subcate extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    
     public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
