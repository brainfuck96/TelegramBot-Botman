<?php

namespace App\Http\Controllers\Bot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libraries\Cinema;

class CinemaController extends Controller
{
    private $cinema;

    public function __construct(Cinema $cinema)
    {
        $this->cinema = $cinema;
    }

    public function show($bot)
    {
        $bot->reply($this->cinema->show());
    }
}