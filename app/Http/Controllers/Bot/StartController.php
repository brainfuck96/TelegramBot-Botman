<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StartController extends Controller
{
    public function index($bot)
    {
        $bot->reply('Список доступных команд:');
        $bot->reply('/task_show - Отображение всех незавершенных заданий');
        $bot->reply('/task_add - Добавления задания в базу');
        $bot->reply('/task_finish {ID задания} - Завершить указаное задание');
        $bot->reply('/task_remove {ID задания} - Удалить указаное задание');
    }
}
