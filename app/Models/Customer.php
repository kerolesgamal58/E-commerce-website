<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Customer extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'phone_number', 'visa_number', 'cash',
    'email_verification_token', 'email_verified_at'];

    public function product(){
        return $this->belongsToMany(Product::class, 'customer_products', 'customer_id', 'product_id');
    }
}
