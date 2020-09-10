<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
    	'product_name', 'product_slug','category_id','brand_id','product_desc','product_content','product_price','product_image','product_status'
    ];
    
    

    public function Brand()
    {
        return $this->belongsTo('App\Brands', 'brand_id', 'id');
    }

    public function Category()
    {
        return $this->belongsTo('App\Categories', 'category_id', 'id');
    }

    public function Order()
    {
        return $this->belongsToMany('App\Orders');
    }
}
