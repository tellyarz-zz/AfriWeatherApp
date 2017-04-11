<?php
/**
 * Created by PhpStorm.
 * User: jade
 * Date: 4/10/17
 * Time: 1:39 PM
 */

namespace AfriWeatherApp;


class OpenWeather
{
    private $apiKey = '';
    private $baseUrl = 'http://api.openweathermap.org/data/2.5/';

    /**
     * Constructor
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Helper function to check if a string is json
     * @param string $someString
     * @return bool
     */
    private function isJson(string $someString) : bool
    {
        $res = false;
        try{
            $result = json_decode($someString);
            if(json_last_error() === JSON_ERROR_NONE){
                $res = true;
            }
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
        return $res;
    }

    /**
     * Get current weather information for a particular city
     * @param string $cityName
     * @return string
     */
    public function getCurrentWeather(string $cityName) : string
    {
        try{
            $weatherUrl = "{$this->baseUrl}weather?q={$cityName}&APPID={$this->apiKey}";
            $weather = CurlFetcher::fetchGet($weatherUrl);
            //confirm if it is a json string
            if($this->isJson($weather))
            {
                return $weather;
            }
            else{
                //not a valid json
                return json_encode(['cod'=>401, 'error'=>'failed to retrieve current weather forecast', 'msg'=>$weather]);
            }
        }catch(\Exception $e) {
            $msg = 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
            return json_encode(['cod'=>401, 'error'=>'failed to retrieve current weather forecast', 'msg'=>$msg]);
        }
    }

    /**
     * Get weather forecast for the week
     * @param string $cityName
     * @return string
     */
    public function getWeatherForecast(string $cityName) : string
    {
        try{
            $weatherUrl = "{$this->baseUrl}forecast?q={$cityName}&APPID={$this->apiKey}";
            $weather = CurlFetcher::fetchGet($weatherUrl);
            //confirm if it is a json string
            if($this->isJson($weather))
            {
                return $weather;
            }
            else{
                //not a valid json
                return json_encode(['cod'=>401, 'error'=>'failed to retrieve weather forecast', 'msg'=>$weather]);
            }
            //var_dump($weather['list'][15]);
        }catch(\Exception $e) {
            $msg = 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
            return json_encode(['cod'=>401, 'error'=>'failed to retrieve weather forecast', 'msg'=>$msg]);
        }
    }


}