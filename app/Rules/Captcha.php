<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Captcha implements Rule
{
    private $googleUrl;
    private $secret;
    private $ip;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->googleUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $this->secret = config('app.captcha_secret_key');
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $res = $this->verifyCaptcha($value);
        return $res;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This captcha is not valid.';
    }

    private function verifyCaptcha($recaptcha) {
        $url="{$this->googleUrl}?secret={$this->secret}&response={$recaptcha}&remoteip={$this->ip}";
        $res=$this->siteVerify($url);
        $res= json_decode($res, true);
        if($res['success']) {
            return true;
        } else {
            return false;
        }
    }

    private function siteVerify($url) {
        $curl = curl_init();
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
        $curlData = curl_exec($curl);
        curl_close($curl);
        return $curlData;
    }
}
