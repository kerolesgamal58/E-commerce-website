<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = ['file', 'file_prev_name', 'size', 'type', 'product_id'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
