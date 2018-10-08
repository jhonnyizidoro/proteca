<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewPostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\FileController;
use App\Models\Post;
use Auth;

class PostController extends Controller
{

    private $pageSize = 5;

    public function showPosts(Request $request)
    {
        $posts = new Post;
        if ($request->titulo){
            $posts = $posts->where('title', 'like', "%{$request->titulo}%");
        }
        $posts = $posts->orderBy('created_at', 'desc')->paginate($this->pageSize)->appends([
            'titulo' => $request->titulo,
        ]);
        return view('admin.posts')->with('posts', $posts);
    }

    public function showEditPostForm($id)
    {
        $post = Post::find($id);
        if ($post && Auth::user()->isAuthorOrAdmin($post)){
            return view('admin.editpost')->with('post', $post);
        }
        return redirect()->route('admin.posts')->with('status', 'Você só pode editar uma notícia caso seja um administrador ou o autor da noticia.');
    }

    public function showNewPostForm()
    {
        return view('admin.newpost');
    }

    public function createPost(NewPostRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['thumbnail'] = FileController::uploadFile($data['thumbnail']);
		$data['url'] = FileController::slugify($data['title']);
		if (Post::where('url', $data['url'])->first()) {
			$data['url'] .= uniqid('_');
		}
        Post::create($data);
        return redirect()->route('admin.posts')->with('status', 'Notícia publicada com sucesso.');
    }

    public function updatePost(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        if (!Auth::user()->isAuthorOrAdmin($post)){
            return redirect()->route('admin.posts')->with('status', 'Você só pode editar uma notícia caso seja um administrador ou o autor da noticia.');
        }
        $data = $request->all();
        if (isset($data['thumbnail'])) {
            $data['thumbnail'] = FileController::uploadFile($data['thumbnail']);
        }
		$data['url'] = FileController::slugify($data['title']);
		if (Post::where('url', $data['url'])->where('id', '!=', $id)->first()) {
			$data['url'] .= uniqid('_');
		}
        $post->update($data);
        return redirect()->route('admin.posts')->with('status', 'Notícia editada com sucesso.');

    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        if (Auth::user()->isAuthorOrAdmin($post)){
            $post->delete();
            return redirect()->route('admin.posts')->with('status', 'Notícia excluída com sucesso.');
        }
        return redirect()->route('admin.posts')->with('status', 'Você só pode excluir uma notícia caso seja um administrador ou o autor da noticia.');
    }
}