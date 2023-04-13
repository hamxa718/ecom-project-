<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'category_id', 'category_type', 'product_name','description', 'price', 'image',
    ];

}
