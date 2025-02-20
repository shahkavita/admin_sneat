<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    //
    protected $table="tbl_city";
    protected $primaryKey="id";
    protected $guarded=[];
    public $timestamps=false;
}
