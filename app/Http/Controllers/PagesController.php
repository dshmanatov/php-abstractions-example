<?php

namespace App\Http\Controllers;

use App\Logic\Builder;

class PagesController extends Controller
{
    public function __invoke()
    {

        return view('layout.app');
    }
}
