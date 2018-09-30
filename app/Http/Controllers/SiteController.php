<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Person;
use App\Work;
use App\Category;
use App\Event;

class SiteController extends Controller
{

	private $postsPageSize = 5;
	private $worksPageSize = 10;
	private $eventsAmount = 5;

    public function home()
    {
        $featuredPosts = Post::orderBy('created_at', 'desc')->take(3)->get();
        $newPosts = Post::orderBy('created_at', 'desc')->take(5)->get();
        $works = Work::orderBy('created_at', 'desc')->take(10)->get();
        return view('site.home')
            ->with('featuredPosts', $featuredPosts)
            ->with('newPosts', $newPosts)
            ->with('works', $works);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function admin()
    {
        return redirect()->route('admin.posts');
    }

    public function posts()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate($this->postsPageSize);
        return view('site.posts')->with('posts', $posts);
    }

    public function post($url)
    {
        $post = Post::where('url', $url)->first();
        return view('site.post')->with('post', $post);
    }

    public function works(Request $request)
    {
		$works = new Work;
        if ($request->has('titulo')){
            $works = $works->where('title', 'like', "%{$request->titulo}%");
        }
        if ($request->has('categoria') && $request->categoria){
            $works = $works->where('category_id', "{$request->categoria}");
        }
        $works = $works->orderBy('title')->paginate($this->worksPageSize)->appends([
            'titulo' => $request->titulo,
            'categoria' => $request->categoria,
        ]);
		$categories = Category::orderBy('category')->get();
		return view('site.works')->with('works', $works)->with('categories', $categories);
    }

    public function team()
    {
        $teammates = Person::where('type', 'team')->orderBy('name')->get();
        return view('site.team')->with('teammates', $teammates);
    }

    public function partners()
    {
        $partners = Person::where('type', 'partner')->orderBy('name')->get();
        return view('site.partners')->with('partners', $partners);
	}
	
	public function events()
	{
		$nextEvent = Event::where('date', '>=', date('Y-m-d'))->orderBy('date', 'asc')->first();
		$events = Event::where('date', '>=', date('Y-m-d'))->orderBy('date', 'asc')->skip(1)->take($this->eventsAmount)->get();
		return view('site.events')->with('nextEvent', $nextEvent)->with('events', $events);
	}

}
