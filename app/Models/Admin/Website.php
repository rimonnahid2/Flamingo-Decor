<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;

class Website extends Model
{
    use HasFactory;
    protected $guarded = [];
     public function Product()
    {
        return $this->hasMany(Product::class);
    }
}
