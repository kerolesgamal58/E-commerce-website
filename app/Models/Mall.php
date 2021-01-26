<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mall extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar', 'name_en', 'facebook', 'twitter', 'website', 'contact_name', 'lat', 'lng', 'logo',
        'email', 'mobile', 'address', 'country_id'
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'mall_products', 'mall_id', 'product_id');
    }
}
