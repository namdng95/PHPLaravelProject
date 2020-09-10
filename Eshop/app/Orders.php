<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
    	'customer_id', 'shipping_id', 'payment_id', 'order_total', 'order_status'
    ];

    public function Payment()
    {
        return $this->belongsTo('App\Payments', 'payment_id', 'id');
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }
    
    public function Product()
    {
        return $this->belongsToMany('App\Products', 'order_details', 'order_id', 'product_id');
    }

    public function Shipping()
    {
        return $this->belongsTo('App\Shipping', 'shipping_id', 'id');
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }

    //Customer
    public function User()
    {
        return $this->belongsTo('App\User', 'customer_id', 'id');
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }
}
