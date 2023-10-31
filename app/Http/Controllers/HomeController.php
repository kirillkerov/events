<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Inertia\Response;
use Inertia\ResponseFactory;

class HomeController extends Controller
{
    /**
     * @return Response|ResponseFactory
     */
    public function __invoke(): Response|ResponseFactory
    {
        return inertia('Home', [
            'title' => 'Главная',
            'events' => Event::with('user')->get(),
        ]);
    }
}
