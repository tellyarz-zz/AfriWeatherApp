# AfriWeatherApp
Fetch current and weather forecast from OpenWeatherMap

<h3>How to use:</h3>
<p>
Install using composer:
<pre>composer require tellyarz/afri-weather-app</pre>
</p>

```php
include 'vendor/autoload.php';

//create open weather object and retrieve weather forecast for 5days
$op = new \AfriWeatherApp\OpenWeather('your_api_key');
$weather = $op->getWeatherForecast('Abuja');

//decode json string
$decodedString = json_decode($weather, true);
if(intVal($decodedString['cod']) === 200)
{
    //we have weather data ready, get the list
    $listData = $decodedString['list'];
    //iterate through list
    foreach($listData as $list) {
        $timeStamp = $list['dt'];
        $timeString = $list['dt_txt'];

        $mainSubArray = $list['main'];
        $tempMin = $mainSubArray['temp_min'];
        $tempMax = $mainSubArray['temp_max'];
        $pressure = $mainSubArray['pressure'];
        $seaLevel = $mainSubArray['sea_level'];
        $groundLevel = $mainSubArray['grnd_level'];
        $humidity = $mainSubArray['humidity'];

        $weatherSubArray = $list['weather'][0];
        $description = $weatherSubArray['main'];
        $condition = $weatherSubArray['description'];
        $icon = "http://openweathermap.org/img/w/{$weatherSubArray['icon']}.png";

        $windSubArray = $list['wind'];
        $speed = $windSubArray['speed'];
        $degree = $windSubArray['deg'];

        //further process here...
    }
}


//to get current weather data
$currentWeather = $op->getCurrentWeather('London');
//decode json string
$decodedString_ = json_decode($currentWeather, true);
if(intVal($decodedString_['cod']) === 200)
{
    //successfully fetched weather data
    var_dump($decodedString_);
}
```