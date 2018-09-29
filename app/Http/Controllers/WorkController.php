<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;
use App\Category;
use App\Http\Requests\NewWorkrequest;
use App\Http\Controllers\FileController;

class WorkController extends Controller
{

    private $pageSize = 10;

    public function showWorks(Request $request)
    {
        $works = new Work;
        if ($request->has('titulo')){
            $works = $works->where('title', 'like', "%{$request->titulo}%");
        }
        if ($request->has('categoria') && $request->categoria){
            $works = $works->where('category_id', "{$request->categoria}");
        }
        $works = $works->orderBy('title')->paginate($this->pageSize)->appends([
            'titulo' => $request->titulo,
            'categoria' => $request->categoria,
        ]);
        $categories = Category::orderBy('category')->get();
        return view('admin.works')->with('works', $works)->with('categories', $categories);
    }

    public function createWork(NewWorkrequest $request)
    {
		$data = $request->all();
		if (isset($data['file'])){
			$data['file'] = FileController::uploadFile($data['file'], 'files');
		}
        Work::create($data);
        return redirect()->back()->with('status', 'Item adicionado à biblioteca com sucesso.');
    }

    public function deleteWork($id)
    {
        Work::destroy($id);
        return redirect()->back()->with('status', 'O item foi removido da biblioteca com sucesso.');
    }
    
}
