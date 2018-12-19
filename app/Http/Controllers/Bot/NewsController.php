<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function show($bot)
    {
        $apiKey = env('NEWSAPI_API_KEY');

        $requestNews = file_get_contents("https://newsapi.org/v2/top-headlines?country=ua&apiKey=$apiKey");
        $requestNewsDecode = json_decode($requestNews);
        $article = rand(0, $requestNewsDecode->totalResults-1);

        $bot->reply('Источник: ' . $requestNewsDecode->articles[$article]->source->name);
        $bot->reply('Новость: ' . $requestNewsDecode->articles[$article]->title);
        $bot->reply('Подробнее: ' . $requestNewsDecode->articles[$article]->url);
    }
}
