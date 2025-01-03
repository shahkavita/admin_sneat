<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    //
    protected $table="employee";
    protected $primaryKey="id";
    protected $guarded=[];
    public $timestamps=false;
}
