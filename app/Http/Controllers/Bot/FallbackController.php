<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FallbackController extends Controller
{
    public function index($bot)
    {
        $bot->reply('Неизвестная команда, попробуй команду: /start');
    }
}
