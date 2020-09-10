<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Details extends Model
{
    protected $table = 'order_details';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
    	'order_id', 'product_id', 'product_name', 'product_price', 'product_quantity', 'discount'
    ];
}
