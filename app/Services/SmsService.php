<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class SmsService
{
    private $username;
    private $password;
    private $sender;
    private $language;
    private $api_url;

    //status of response
    private const SUCCESS = "1901";

    //return actions
    public const  RETURN_SUCCESS = "success";
    public const  RETURN_FAILED = "failed";

    // public static $return_success = self::RETURN_SUCCESS;
    
    public function __construct()
    {
        $this->api_url = env("SMS_API_URL");
        $this->username = env("SMS_USERNAME");
        $this->password = env("SMS_PASSWORD");
        $this->sender = env("SMS_SENDER");
        $this->language = env("SMS_LANGUAGE");
    }
    /**
     * send the msg to client 
     * @param string phone
     * 
     * @param string message
     * 
     * @return string 
     */

    public function sendSmsMsg($phone, $message)
    {

        $phone = $this->validateNumber($phone);
        
        $request = Http::post("{$this->api_url}?username={$this->username}&password={$this->password}&language={$this->language}&sender={$this->sender}&mobile={$phone}&message={$message}");

        if ($request['code'] == self::SUCCESS) {
            return self::RETURN_SUCCESS;
        } else {
            return self::RETURN_FAILED;
        }
        // return $request;
    }

    private function validateNumber($number)
    {
        $count = Str::length($number); //11
        $regular = Str::startsWith($number , 0); // 0
        if($count == 11 && $regular == 1) {
            return 2 . $number;
        }
        return $number;
    }
}
