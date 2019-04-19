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

    protected $appends = ['product_image_path','product_image_thumb_path'];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function getProductImagePathAttribute() {
        $image_url = productImagePath($this->images);
        return ($image_url) ? $image_url : '';
    }

    public function getProductImageThumbPathAttribute() {
        $image_url = productImageThumbPath($this->images);
        return ($image_url) ? $image_url : '';
    }


}
