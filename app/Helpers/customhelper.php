<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

    function greetuser($username)
    {
        return "Welocme".ucfirst($username)."to Flipcart";
    }
   if(!function_exists('getcountry'))
   {
        function getcountry()
        {
            return DB::table('country_tbl')->get();
        }
   } 
?>