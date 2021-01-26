<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mobile', 'code', 'logo', 'currency'];


    public function cities(){
        return $this->hasMany(City::class, 'country_id', 'id');
    }

    public function states(){
        return $this->hasMany(State::class, 'country_id', 'id');
    }

    public function malls(){
        return $this->hasMany(Mall::class, 'country_id', 'id');
    }

    public function shipping_companies(){
        return $this->belongsToMany(Shipping::class, 'country_shippings', 'country_id', 'shipping_id');
    }
}
