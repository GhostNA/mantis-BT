<?php


namespace app;

use app\Request;
use app\Helper;

class GetRequest implements Request
{
    /**
     * @param $data
     * @return mixed
     */
    public function call($data)
    {
        $requestid = Helper::generateRequestID(6);
        $url = $data['url'] . $data['endpoint'] . "?" . ((is_array($data['params']) ? http_build_query($data['params']) : $data['params']));
        var_dump($url);

        Helper::log(['requestid' => $requestid, 'type' => 'request', 'method' => 'GET', 'url' => $url]);
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: " . $data['token'],
        ]);
        curl_setopt($curl, CURLOPT_ENCODING, "UTF-8");

        #curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        #curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($curl);
        Helper::log(['requestid' => $requestid, 'type' => 'response', 'method' => 'GET'], $response);
        curl_close($curl);

        return $response;
    }
}