<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;
use App\Category;
use App\Http\Requests\NewWorkrequest;
use Storage;
use File;

class WorkController extends Controller
{
    public function showWorks()
    {
        $works = Work::get();
        $categories = Category::get();
        return view('admin.works')->with('works', $works)->with('categories', $categories);
    }

    public function createWork(NewWorkrequest $request)
    {
        //File upload
        $file = $request->file;
        $name = $this->sanitizeFileName($file->getClientOriginalName());
        $name = 'works/files/'.date("Y-m-d_H-i-s").'_'.$name;
        $file = File::get($file);
        Storage::disk('public')->put($name, $file);
        //Store in database
        $data = $request->all();
        $data['file'] = $name;
        Work::create($data);
        return redirect()->back()->with('status', 'Item adicionado à biblioteca com sucesso.');
    }

    /**
     * Faz parte da api! Recebe uma requisição post, faz o upload da imagem
     * Retorna o endereço da imagem como json, o endereço fica no atributo "location"
     */
    public function imageUpload(Request $request)
    {
        $image = $request->file;
        $name = $this->sanitizeFileName($image->getClientOriginalName());
        $name = 'works/images/'.date("Y-m-d_H-i-s").'_'.$name;
        $image = File::get($image);
        Storage::disk('public')->put($name, $image);
        return response()->json(['location' => $name]);
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

    public function deleteWork($id)
    {
        Work::destroy($id);
        return redirect()->back()->with('status', 'O item foi removido da biblioteca com sucesso.');
    }
    
}
