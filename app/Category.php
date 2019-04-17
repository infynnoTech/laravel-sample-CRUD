<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';

    protected $primaryKey = 'id'; // or null
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
        'name', 'status','description','created_at','updated_at','deleted_at',
    ];

    public function scopeEnabled($query)
    {
       return $query->where('categories.status', '=', '1');
    }
    public function scopeDisaled($query)
    {
        return $query->where('categories.status', '=', '0');
    }
}
