<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_product_id', 'customer_id', 'country_id', 'city_id', 'shipping_company_id', 'address', 'postcode', 'email', 'mobile'];

    public function customer_product(){
        return $this->belongsTo(CustomerProduct::class, 'customer_product_id', 'id');
    }

    public function shipping(){
        return $this->belongsTo(Shipping::class, 'shipping_company_id', 'id');
    }
}
