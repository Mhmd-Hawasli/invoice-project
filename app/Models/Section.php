<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
    'section_name',
    'description',
    'user_id'
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
