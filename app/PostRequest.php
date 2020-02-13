<?php

namespace app;

use app\Request;
use app\Helper;

class PostRequest implements Request
{
    /**
     * Send request
     *
     * @param $data
     * @return mixed
     */
    public function call($data)
    {
        $requestid = Helper::generateRequestID(6);
        Helper::log(['requestid' => $requestid, 'type' => 'request', 'method' => 'POST', 'data' => $data]);

        $curl = curl_init($data['url'] . $data['endpoint']);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: " . $data['token'], 'Content-Type:application/json']);

        # If you want validate SSL
        #curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        #curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data['params']));

        $response = curl_exec($curl);

        Helper::log(['requestid' => $requestid, 'type' => 'response', 'method' => 'POST'], $response);

        curl_close($curl);

        return $response;
    }
}