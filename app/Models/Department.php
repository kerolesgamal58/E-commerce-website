<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en', 'logo', 'description', 'keyword', 'parent_id'];

    public function departments(){
        return $this->hasMany(Department::class, 'parent_id', 'id');
    }

}
