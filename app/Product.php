<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $table = 'products';

    protected $primaryKey = 'id'; // or null
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
        'category_id','name','price','status','created_at','updated_at','deleted_at',
    ];


    public function category()
    {
      return $this->belongsTo('App\Category');
    }
    public function productdetail()
    {
      return $this->hasOne('App\ProductDetail','product_id');
    }

    public function scopeEnabled($query)
    {
       return $query->where('products.status', '=', '1');
    }
    public function scopeDisaled($query)
    {
        return $query->where('products.status', '=', '0');
    }
}
