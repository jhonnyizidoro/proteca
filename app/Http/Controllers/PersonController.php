<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use App\Http\Requests\NewPersonRequest;
use Storage;
use File;

class PersonController extends Controller
{
    public function showPeople()
    {
        $partners = Person::where('type', 'partner')->orderBy('name')->get();
        $members = Person::where('type', 'team')->orderBy('name')->get();
        return view('admin.people')->with('partners', $partners)->with('members', $members);
    }

    public function createPerson(NewPersonRequest $request)
    {
        $data = $request->all();
        $data['image'] = $this->uploadImage($data['image']);
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

    /**
     * Recebe uma thumbnail em formato de arquivo e retorna a location dela
     */
    public function uploadImage($image)
    {
        $name = $this->sanitizeFileName($image->getClientOriginalName());
        $name = 'people/'.date("Y-m-d_H-i-s").'_'.$name;
        $image = File::get($image);
        Storage::disk('public')->put($name, $image);
        return $name;
    }

    /**
     * Recebe o nome completo de um arquivo, por exemplo "eu âmOô programar hehexD.docx"
     * Retorna o nome de uma maneira mais compatível, exemplo eu-amoo-programar-hehexd.docx
     */
    public static function sanitizeFileName($filename)
    {
        //Separar o nome e a extensão do arquivo
        $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
        $array = explode('.', $filename);
        $extension = end($array);
        //Modificar o nome do arquivo para tirar caracteres especiais
        $name = preg_replace('~[^\pL\d]+~u', '-', $name);
        $name = iconv('utf-8', 'us-ascii//TRANSLIT', $name);
        $name = preg_replace('~[^-\w]+~', '', $name);
        $name = trim($name, '-');
        $name = preg_replace('~-+~', '-', $name);
        $name = strtolower($name);
        if (empty($name)) {
            $name = 'n-a';
        }
        return $name.'.'.$extension;
    }

}
