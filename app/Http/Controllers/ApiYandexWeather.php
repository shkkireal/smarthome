<?php


namespace App\Http\Controllers;


use mysql_xdevapi\Exception;

class ApiYandexWeather
{

    /**
     * ApiYandexWeather constructor.
     */
    public function __construct()
    {

            $this->apiYandexKey = env("API_KEY_YANDEX", null);
            if(empty($this->apiYandexKey)) throw new Exception('empty API_KEY_YANDEX!');



    }
    public function getWeather(){

        $opts = [
            'http' => [
                'method'=>"GET",
                'header' => "X-Yandex-API-Key:".$this->apiYandexKey."\r\n"
            ]
        ];
        $context = stream_context_create($opts);
        $fullAnswer=file_get_contents("https://api.weather.yandex.ru/v2/forecast/?lat=55.466106303245205&lon=37.55812658740232&lang=ru_RU",false,$context);
        $fullAnswer=json_decode($fullAnswer);
        $this->weather = $fullAnswer->fact;

    }

}
