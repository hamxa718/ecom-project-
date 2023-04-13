<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_product extends Model
{
    protected $table = 'order_product';
    protected $fillable = [
        'order_id','product_id','product_name', 'qty','name', 'price', 'weight',
    ];

}
