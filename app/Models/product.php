<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $table="product";
    protected $primaryKey="p_id";
    protected $guarded=[];
    protected $keyType = 'int';
    public $timestamps=false;
    public function category()
    {
        return $this->belongsTo(product_category::class, 'category_id');
    }
}
