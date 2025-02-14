<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class generalSettings extends Model
{
    //
    protected $table="general_settings";
    protected $primaryKey="id";
    protected $guarded=[];
    public static function getValue($key)
    {
        return self::where('key', $key)->value('value');
    }

    public static function setValue($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
