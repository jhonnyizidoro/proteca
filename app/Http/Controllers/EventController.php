<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewEventRequest;
use App\Event;

class EventController extends Controller
{

    private $pageSize = 15;

    public function showEvents(Request $request)
    {
        $events = new Event;
        if ($request->has('evento')){
            $events = $events->where('name', 'like', "%{$request->evento}%");
        }
        if ($request->has('data') && $request->data){
            $request->data == 'passados' ? $operation = '<' : $operation = '>';
            $events = $events->where('date', $operation, date("Y-m-d"));
        }
        $events = $events->orderBy('date', 'desc')->paginate($this->pageSize)->appends([
            'evento' => $request->evento,
            'data' => $request->data,
        ]);
        return view('admin.events')->with('events', $events);
    }

    public function createEvent(NewEventRequest $request)
    {
        $data = $request->all();
        $dateArray = explode('/', $data['date']);
        $data['date'] = $dateArray[2] . '-' . $dateArray[1] . '-' . $dateArray[0];
        $event = Event::create($data);
        return redirect()->route('admin.events')->with('status', "O evento <b>\"{$event->name}\"</b> foi adicionado com sucesso!");
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id);
        $event->delete();
        return redirect()->route('admin.events')->with('status', "O evento <b>\"{$event->name}\"</b> foi excluído com sucesso!");
    }

}
