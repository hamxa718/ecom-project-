<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name','email', 'number', 'company_name',
        'address_first', 'address_second', 'city','country', 'product_price_subtotal', 'payment_process',
    ];
}
