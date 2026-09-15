<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiRequestModel extends Model
{
    //
    public static function RequestService($url,$header,$postfields,$method)
    {
        $postfields_array = json_encode($postfields);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,            $url );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST,           1 );
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        curl_setopt($ch, CURLOPT_POSTFIELDS,     $postfields_array );
        curl_setopt($ch, CURLOPT_HTTPHEADER,     $header);
        $result=curl_exec ($ch);

        return  json_decode($result);
    }


}
