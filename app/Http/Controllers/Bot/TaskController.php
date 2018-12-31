<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;

class TaskController extends Controller
{
    public function show($bot)
    {
        $chat_id = $bot->getMessage()->getSender();
        $tasks = Task::where('completed', false)
            ->where('chat_id', $chat_id)
            ->get();

        if (count($tasks) > 0) {
            $bot->reply('Ваши задания:');
            foreach($tasks as $task) {
                $bot->reply('[' . $task->id . ']' . '  - ' . $task->task);
            }
        } else {
            $bot->reply('У вас нет незавершенных заданий');
        }
    }

    public function add($bot)
    {   
        $bot->ask('Какое задание Вы хотите добавить?', function($answer, $conversation) {
            $chat_id = $conversation->getBot()->getMessage()->getSender();
            Task::create([
                 'chat_id' => $chat_id,
                 'task' => $answer
             ]);
            $conversation->say('Ваше задание успешно добавленно');
        });
    }

    public function finish($bot, $taskId)
    {
        $chat_id = $bot->getMessage()->getSender();

        $task = Task::where('chat_id', $chat_id)
            ->where('id', $taskId)
            ->first();

        if(is_null($task)) {
            $bot->reply('Задание не найдено');
        } else {
            $task->completed = true;
            $task->save();
            $bot->reply('Задание [' . $task->id . '] выполненно!');
        } 
    }

    public function remove($bot, $taskId)
    {
        $chat_id = $bot->getMessage()->getSender();

        $task = Task::where('chat_id', $chat_id)
            ->where('id', $taskId)
            ->first();

        if(is_null($task)) {
            $bot->reply('Задание не найдено');
        } else {
            $task->delete();
            $bot->reply('Задание [' . $task->id . '] удалено!');
        } 
    }
}
