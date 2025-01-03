<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $table="product";
    protected $primaryKey="id";
    protected $guarded=[];
    public $timestamps=false;
}
