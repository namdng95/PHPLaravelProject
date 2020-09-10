<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payment';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
    	'payment_method', 'payment_status'
    ];

    public function Order()
    {
        return $this->hasMany('App\Orders', 'payment_id', 'id');
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }
}
