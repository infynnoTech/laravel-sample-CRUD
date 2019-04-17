<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use SoftDeletes;
    protected $table = 'product_details';

    protected $primaryKey = 'id'; // or null
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
        'product_id','color','height','width','weight','stock','description','images','created_at','updated_at','deleted_at',
    ];

    public function product()
    {
      return $this->belongsTo('App\Product');
    }

    
}
