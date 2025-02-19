<?php
use Illuminate\Support\Facades\Config;
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
            return DB::table('tbl_country')->get();
        }
   } 
   if(!function_exists('getsmtp'))
   {
        function getsmtp()
        {
            return DB::table('smtp')->pluck('value','key')->toArray();
        }
   }
   if(!function_exists('setsmtpConfig'))
   {
        function setsmtpConfig()
        {
            $smtpsetting=getsmtp();
            Config::set('mail.mailer','smtp');
            Config::set('mail.host', $smtpsetting['host'] ?? env('MAIL_HOST'));
            Config::set('mail.port', $smtpsetting['port'] ?? env('MAIL_PORT'));
            Config::set('mail.username', $smtpsetting['username'] ?? env('MAIL_USERNAME'));
            Config::set('mail.password', $smtpsetting['password'] ?? env('MAIL_PASSWORD'));
            Config::set('mail.encryption', $smtpsetting['encryption'] ?? env('MAIL_ENCRYPTION'));
            Config::set('mail.from.address', $smtpsetting['email'] ?? env('MAIL_FROM_ADDRESS'));
            Config::set('mail.from.name', $smtpsetting['email'] ?? env('MAIL_FROM_NAME'));
      
        }
   }
?>