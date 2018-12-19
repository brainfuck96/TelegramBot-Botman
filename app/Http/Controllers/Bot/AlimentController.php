<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlimentController extends Controller
{
    public function show($bot)
    {   
        $bot->ask('Введите ФИО на украинском языке (Пример: Шевченко Олександр Володимирович)', function($answer, $conversation) {
            $apiKey = env('OPENDATA_API_KEY');

            $requestAliment = file_get_contents("https://opendatabot.com/api/v2/aliment?apiKey=$apiKey&pib=$answer");
            $requestAlimentDecode = json_decode($requestAliment);

            if ($requestAlimentDecode->count > 0) {
                foreach ($requestAlimentDecode->aliments as $alimentPerson) {
                    $response = '===================' . PHP_EOL;
                    $response .= 'ФИО: ' . $alimentPerson->full_name . PHP_EOL;
                    $response .= 'Дата рождения: ' . $alimentPerson->birth_date . PHP_EOL;
                    $conversation->say($response);
                }
            } else {
                $conversation->say('По запросу ничего не найено');
            }
        });
    }
}
