<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');

$botman->group(['driver' => ['Telegram']], function($bot) {
    $bot->hears('/start', 'App\Http\Controllers\Bot\StartController@telegram');
});

$botman->group(['driver' => ['Web']], function($bot) {
    $bot->hears('/start', 'App\Http\Controllers\Bot\StartController@web');
});

$botman->group(['prefix' => 'test_'], function($bot) {
    $bot->hears('1', function($bot) {
        $bot->reply('Prefix response');
    });
});

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

$botman->hears(
    '/cinema_show',
    'App\Http\Controllers\Bot\CinemaController@show'
);

$botman->fallback('App\Http\Controllers\Bot\FallbackController@index');
