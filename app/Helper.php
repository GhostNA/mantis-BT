<?php


namespace app;


class Helper
{
    /**
     * Generate request id
     *
     * @param $length
     * @return string|null
     */
    public static function generateRequestID($length)
    {
        if (!is_integer($length)) {
            return null;
        }

        $chars = "1234567890";

        $id = null;
        while ($length--) {
            $id .= $chars[rand(0, StrLen($chars) - 1)];
        }

        return $id;
    }


    /**
     * Logging
     *
     * @param $data
     * @param null $response
     */
    public static function log($data, $response = null)
    {
        if (!getenv('LOG')) {
            return;
        }

        if ($data) {
            $data = array_merge(['date' => date('Y-m-d H:i:s')], $data);
        }

        if (!empty($response)) {
            $json_validate = json_decode($response);

            $data['response'] = (json_last_error() === JSON_ERROR_NONE) ? $json_validate : $response;
        }

        file_put_contents(getenv('LOG_FILE'), json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n", FILE_APPEND);
    }
}