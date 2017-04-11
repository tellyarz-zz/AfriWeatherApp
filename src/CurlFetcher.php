<?php
/**
 * Created by PhpStorm.
 * User: jade
 * Date: 4/10/17
 * Time: 3:10 PM
 */

namespace AfriWeatherApp;


class CurlFetcher
{
    /**
     * HTTP Get method
     * @param string $url
     * @return string
     */
    public static function fetchGet(string $url) : string
    {
        $curl = curl_init();
        $resp = '';
        try
        {
            // Set some options
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url
            ));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
        }
        catch(\Exception $e)
        {
            $error_msg = curl_error($curl);
            $error_code = curl_errno($curl);
            $resp = "Error: {$error_msg} - Code: {$error_code}";
        }
        curl_close($curl);
        return $resp;
    }

    /**
     * HTTP Post method
     * @param string $url
     * @param array $postFields
     * @return string
     */
    public static function fetchPost(string $url, array $postFields) : string
    {
        // Get cURL resource
        $curl = curl_init();
        $resp = '';
        try
        {
            // Set some options
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $postFields
            ));
            // Send the request & save response to $resp
            $resp = curl_exec($curl);
        }
        catch(\Exception $e)
        {
            $error_msg = curl_error($curl);
            $error_code = curl_errno($curl);
            $resp = "Error: {$error_msg} - Code: {$error_code}";
        }
        curl_close($curl);
        return $resp;
    }
}