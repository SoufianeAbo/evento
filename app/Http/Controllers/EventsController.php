<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function create(Request $request): RedirectResponse
    {   
        $events = Events::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'categoryId' => $request->categoryId,
            'spots' => $request->spots,
            'activation' => $request->activation,
        ]);

        return redirect('/dashboard');
    }
}
