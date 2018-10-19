<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewEventRequest;
use App\Models\Event;

class EventController extends Controller
{

    private $pageSize = 15;

    public function showEvents(Request $request)
    {
        $events = new Event;
        if ($request->evento){
            $events = $events->where('name', 'like', "%{$request->evento}%");
        }
        if ($request->data){
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
		$data['date'] = "{$dateArray[2]}-{$dateArray[1]}-$dateArray[0]";
        $event = Event::create($data);
        return redirect()->route('admin.events')->with('status', "Evento adicionado com sucesso!");
    }

    public function deleteEvent($id)
    {
        $event = Event::find($id)->delete();
        return redirect()->route('admin.events')->with('status', "Evento removido com sucesso!");
    }

}