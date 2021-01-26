<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en', 'user_id', 'lat', 'lng', 'logo'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function countries(){
        return $this->belongsToMany(Country::class, 'country_shippings', 'shipping_id', 'country_id');
    }
}
