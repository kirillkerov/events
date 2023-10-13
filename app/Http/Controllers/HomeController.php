<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        return inertia('Home', [
            'title' => 'Главная',
            'events' => Event::with('user')->get(),
        ]);
    }
}
