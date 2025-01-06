<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_category extends Model
{
    //
    protected $table="product_category";
    protected $primaryKey="id";
    protected $guarded=[];
    public $timestamps=false;
}
