<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'main_image', 'other_data', 'stock', 'price', 'status', 'reason', 'start_at',
        'end_at', 'start_offer_at', 'end_offer_at', 'price_offer', 'department_id', 'trademark_id',
        'manufacture_id', 'color_id', 'size_id', 'size', 'weight_id', 'weight', 'currency_id',
    ];

    public function files(){
        return $this->hasMany(File::class, 'product_id', 'id');
    }

    public function other_data(){
        return $this->hasMany(OtherData::class, 'product_id', 'id');
    }

    public function malls(){
        return $this->belongsToMany(Mall::class, 'mall_products', 'product_id', 'mall_id');
    }

    public function color(){
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function currency(){
        return $this->belongsTo(Country::class, 'currency_id', 'id');
    }

    public function customer(){
        return $this->belongsToMany(Customer::class, 'customer_products', 'product_id', 'customer_id');
    }
}
