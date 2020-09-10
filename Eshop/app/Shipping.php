<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shipping';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
    	'shipping_name','shipping_address','shipping_email','shipping_phone','shipping_desc'
    ];

    public function Order()
    {
        return $this->hasMany('App\Shipping', 'shipping_id', 'id');
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }

}
