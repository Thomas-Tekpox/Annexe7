<?php

namespace App\Service\Pbo;

class PboService
{
    public function index()
    {
        //
    }

    public function ifr($Test, $Oui, $Non="") {
        if ($Test) {
            return $Oui;
        }
        return $Non;
    }


        
    public function SendReq($url, $post, $post_data, $user_agent, $cookies, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
    
        if ($cookies) {
            curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
        } else {
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
        }
    
        if ($headers) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($ch);
        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // dd(array($http, $response));
        return array($http, $response);
    }

}