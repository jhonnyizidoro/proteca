<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewPostRequest;
use App\Http\Requests\UpdatePostRequest;
use Storage;
use File;
use Auth;
use App\Post;

class PostController extends Controller
{
    public function showPosts()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.posts')->with('posts', $posts);
    }

    public function showNewPostForm()
    {
        return view('admin.newpost');
    }

    public function showEditPostForm($id)
    {
        $post = Post::find($id);
        if (Auth::user()->isAuthorOrAdmin($post)){
            return view('admin.editpost')->with('post', $post);
        }
        return redirect()->back()->with('status', 'Você só pode editar uma notícia caso seja um administrador ou o autor da noticia.');
    }




    public function createPost(NewPostRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        //Thumbnail Upload
        $thumbnail = $data['thumbnail'];
        $name = $this->sanitizeFileName($thumbnail->getClientOriginalName());
        $name = 'posts/thumbnail/'.date("Y-m-d_H-i-s").'_'.$name;
        $thumbnail = File::get($thumbnail);
        Storage::disk('public')->put($name, $thumbnail);
        $data['thumbnail'] = $name;
        //Gerar URL da notícia
        $data['url'] = $this->slugify($data['title']);
        Post::create($data);
        return redirect()->route('admin.posts')->with('status', 'Notícia publicada com sucesso.');
    }

    public function updatePost(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);
        if (!Auth::user()->isAuthorOrAdmin($post)){
            return redirect()->back();
        }
        $data = $request->all();
        //Se tiver thumbnail no request, ele atualiza
        if (isset($data['thumbnail'])) {
            $thumbnail = $data['thumbnail'];
            $name = $this->sanitizeFileName($thumbnail->getClientOriginalName());
            $name = 'posts/thumbnail/'.date("Y-m-d_H-i-s").'_'.$name;
            $thumbnail = File::get($thumbnail);
            Storage::disk('public')->put($name, $thumbnail);
            $data['thumbnail'] = $name;
        }
        //Gerar URL da notícia
        $data['url'] = $this->slugify($data['title']);
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
        return redirect()->back()->with('status', 'Você só pode excluir uma notícia caso seja um administrador ou o autor da noticia.');
    }


    
    
    /**
     * Faz parte da api! Recebe uma requisição post, faz o upload da imagem
     * Retorna o endereço da imagem como json, o endereço fica no atributo "location"
     */
    public function imageUpload(Request $request)
    {
        $image = $request->file;
        $name = $this->sanitizeFileName($image->getClientOriginalName());
        $name = 'posts/images/'.date("Y-m-d_H-i-s").'_'.$name;
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

    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        return $text;
    }


}
