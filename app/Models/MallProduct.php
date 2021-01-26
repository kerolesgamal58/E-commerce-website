<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MallProduct extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'mall_id'];
}
