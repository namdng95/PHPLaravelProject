<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
    	'brand_name', 'brand_slug', 'brand_status'
    ];

    public function Product()
    {
        return $this->hasMany('App\Products', 'brand_id', 'id');
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key'); 
    }
}
