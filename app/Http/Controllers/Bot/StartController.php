<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StartController extends Controller
{
    public function web($bot)
    {
        $bot->reply('Список доступных команд:');
        $bot->reply('/task_show - Отображение всех незавершенных заданий');
        $bot->reply('/task_add - Добавления задания в базу');
        $bot->reply('/task_finish {ID задания} - Завершить указаное задание');
        $bot->reply('/task_remove {ID задания} - Удалить указаное задание');
        $bot->reply('/cinema_show - Отобразить расписание сеансов ТРК Галактика');
    }

    public function telegram($bot)
    {
        $bot->reply('Список доступных команд:' . PHP_EOL
            . '=== Команды менеджера задач ===' . PHP_EOL
            . '/task_show - Отображение всех незавершенных заданий' . PHP_EOL
            . '/task_add - Добавления задания в базу' . PHP_EOL
            . '/task_finish {ID задания} - Завершить указаное задание' . PHP_EOL
            . '/task_remove {ID задания} - Удалить указаное задание' . PHP_EOL
            . '=== Команды кинобота ===' . PHP_EOL
            . '/cinema_show - Отобразить расписание сеансов ТРК Галактика' . PHP_EOL
        );
    }
}
