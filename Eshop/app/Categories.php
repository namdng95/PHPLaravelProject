<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
    	'category_name', 'category_slug', 'category_status'
    ];

    public function Product()
    {
        return $this->hasMany('App\Products', 'category_id', 'id');
        //return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
    }
}
