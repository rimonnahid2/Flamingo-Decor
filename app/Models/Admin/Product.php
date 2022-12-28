<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;
use App\Models\Admin\Subcate;
use App\Models\Admin\Website;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
     public function Category()
    {
        return $this->belongsTo(Category::class);
    }
     public function Subcate()
    {
        return $this->belongsTo(Subcate::class);
    }
     public function Website()
    {
        return $this->belongsTo(Website::class);
    }



    public function fb()
    {
        return url("https://www.facebook.com/sharer.php?u=" . route('single.product',$this->slug));
    }

    public function twitter()
    {
        return url("https://twitter.com/intent/tweet?url=" . route('single.product',$this->slug));
    }

    public function linkedin()
    {
        return url(" http://www.linkedin.com/shareArticle?mini=true&url=" . route('single.product',$this->slug));
    }
    public function pin()
    {
        return url("https://www.pinterest.com/pin/create/button/?url=" . route('single.product',$this->slug));
    }
}
