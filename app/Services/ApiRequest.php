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

    /**
     * @param $url
     * @param $data
     * @return array list
     */
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

        $res = curl_exec($curl);
        $err = curl_error($curl);

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($err) {
            $response = $err;
        } else {
            $response = $res;
        }

        return array(\GuzzleHttp\json_decode($response) , $httpcode);
    }
}