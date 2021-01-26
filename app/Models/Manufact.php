<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufact extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar', 'name_en', 'facebook', 'twitter', 'website', 'contact_name', 'lat', 'lng', 'logo',
        'email', 'mobile', 'address'
    ];
}
