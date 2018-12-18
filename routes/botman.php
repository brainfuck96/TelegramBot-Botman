<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->hears('/start', 'App\Http\Controllers\Bot\StartController@index');

$botman->hears(
    '/task_show',
    'App\Http\Controllers\Bot\TaskController@show'
);

$botman->hears(
    '/task_add',
    'App\Http\Controllers\Bot\TaskController@add'
);

$botman->hears(
    '/task_finish {taskId}',
    'App\Http\Controllers\Bot\TaskController@finish'
);

$botman->hears(
    '/task_remove {taskId}',
    'App\Http\Controllers\Bot\TaskController@remove'
);

$botman->fallback('App\Http\Controllers\Bot\FallbackController@index');
