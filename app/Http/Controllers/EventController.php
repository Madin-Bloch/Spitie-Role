<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::latest()->get();
        return view('events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all,[
                'title' => 'required',
                'description' => 'nullable',
                'date' => 'required|date'
            ]);

            if($validate->fails()){
                return redirect()->back()->withErrors($validate);
            }

            Event::create($request->all());

            return redirect()->route('events.index')->with('success',"Event created successfully");
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
    return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'date' => 'required|date',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
         $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }
}
