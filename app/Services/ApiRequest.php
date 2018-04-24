<?php
namespace App\Services;


class ApiRequest
{
    public static function get($url , $credentials = null , $prams = null )
    {

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', $url , [
            'data' => $prams
        ]);

        $result = $response->getBody()->getContents();

        $retData = [];
        if (!empty($result)) {
            $apiInvt = json_decode($result, true);
            $retData = $apiInvt;
        }

        return $retData;

    }

    public static function curlRequest($url , $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "cache-control: no-cache",
                "content-type: application/json",
                "user-agent: Coderjp API Client v2.0"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
}