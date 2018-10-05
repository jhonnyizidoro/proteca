<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Http\Requests\NewPersonRequest;
use App\Http\Controllers\FileController;

class PersonController extends Controller
{
    public function showPeople()
    {
        $partners = Person::where('type', 'partner')->orderBy('name')->get();
        $teammates = Person::where('type', 'team')->orderBy('name')->get();
        return view('admin.people')->with('partners', $partners)->with('teammates', $teammates);
    }

    public function createPerson(NewPersonRequest $request)
    {
        $data = $request->all();
        $data['image'] = FileController::uploadFile($data['image']);
        Person::create($data);
        $data['type'] == 'team' ? $type = 'Membro da equipe' : $type = 'Parceiro';
        return redirect()->route('admin.people')->with('status', "{$type} adicionado com sucesso!");
    }

    public function deletePerson($id)
    {
        $person = Person::find($id);
        $person->type == 'team' ? $type = 'Membro da equipe' : $type = 'Parceiro';
        $person->delete();
        return redirect()->route('admin.people')->with('status', "{$type} excluído com sucesso!");
    }

}
