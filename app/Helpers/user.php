<?php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

    function greetuser($username)
    {
        return "Welocme".ucfirst($username)."to Flipcart";
    }
?>