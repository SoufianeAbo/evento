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
            'organizerId' => $request->organizerId,
            'status' => $request->status,
        ]);

        return redirect('/dashboard');
    }

    public function delete(Request $request): RedirectResponse
    {
        $event = Events::find($request->eventId);
        $event->delete();

        return redirect('/dashboard');
    }
}
