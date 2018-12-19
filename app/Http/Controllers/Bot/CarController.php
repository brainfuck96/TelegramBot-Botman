<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    public function show($bot)
    {   
        $bot->ask('Введите номер автомобиля на украинском языке (Пример: BI0020AE)', function($answer, $conversation) {
            $apiKey = env('OPENDATA_API_KEY');

            $requestCarId = file_get_contents("https://opendatabot.com/api/v2/transport?apiKey=$apiKey&limit=1&number=$answer");
            $requestCarIdDecode = json_decode($requestCarId);
            if (count($requestCarIdDecode->data) > 0) {
                $carId = $requestCarIdDecode->data[0]->id;
                $requestCar = file_get_contents("https://opendatabot.com/api/v2/transport/$carId?apiKey=$apiKey");
                $requestCarDecode = json_decode($requestCar);

                $conversation->say('Номер автомобиля: ' . $requestCarDecode->number);
                $conversation->say('Модель: ' . $requestCarDecode->model);
                $conversation->say('Год выпуска: ' . $requestCarDecode->year);
                $conversation->say('Дата регистрации: ' . $requestCarDecode->date);
                $conversation->say('Обьем двигателя: ' . $requestCarDecode->capacity);
                $conversation->say('Цвет: ' . $requestCarDecode->color);
                $conversation->say('Вес: ' . $requestCarDecode->own_weight);
                $conversation->say('Тип: ' . $requestCarDecode->kind . ' ' . $requestCarDecode->body);
            } else {
                $conversation->say('По запросу ничего не найено');
            }
        });
    }
}
