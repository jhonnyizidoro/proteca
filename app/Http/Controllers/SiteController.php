<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Artisan;
use App\Models\SiteContent\FeaturedPost;
use App\Models\SiteContent\FeaturedVideo;
use App\Models\Post;
use App\Models\Person;
use App\Models\Work;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;

class SiteController extends Controller
{

	private $postsPageSize = 5;
	private $worksPageSize = 10;
	private $eventsAmount = 5;

	public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function admin()
    {
        return redirect()->route('admin.featured');
    }

    public function home()
    {
		$featuredPosts = FeaturedPost::get();
		$mainFeaturedVideo = FeaturedVideo::where('main', true)->first();
	    $featuredVideos = FeaturedVideo::where('main', '!=', true)->get();
        $newPosts = Post::orderBy('created_at', 'desc')->take(5)->get();
		$works = Work::orderBy('created_at', 'desc')->take(10)->get();
		
        return view('site.home', [
			'featuredPosts' => $featuredPosts,
            'newPosts' => $newPosts,
			'works' => $works,
			'mainFeaturedVideo' => $mainFeaturedVideo,
			'featuredVideos' => $featuredVideos,
		]);
    }

    public function posts(Request $request)
    {
		$posts = new Post;
        if ($request->has('titulo')){
            $posts = $posts->where('title', 'like', "%{$request->titulo}%");
        }
        $posts = $posts->orderBy('created_at', 'desc')->paginate($this->postsPageSize)->appends([
            'titulo' => $request->titulo,
        ]);
        return view('site.posts', [
			'posts' => $posts,
			'title' => 'Notícias',
			'description' => 'Notícias sobre violência infantil e aliciamento de crianças e adolescentes'
		]);
    }

    public function post($url)
    {
        $post = Post::where('url', $url)->first();
        return view('site.post', [
			'post' => $post,
			'description' => isset($post->title) ? $post->title : null
		]);
    }

    public function works(Request $request)
    {
		$works = new Work;
        if ($request->titulo){
            $works = $works->where('title', 'like', "%{$request->titulo}%");
        }
        if ($request->categoria){
            $works = $works->where('category_id', "{$request->categoria}");
        }
        $works = $works->orderBy('title')->paginate($this->worksPageSize)->appends([
            'titulo' => $request->titulo,
            'categoria' => $request->categoria,
        ]);
		$categories = Category::orderBy('category')->get();
		return view('site.works', [
			'works' => $works,
			'categories' => $categories,
			'title' => 'Biblioteca',
			'description' => 'Artigos, Cartilhas, Leis, Livros e Resenhas sobre violência e abuso infantil e do adolescente'
		]);
	}
	
	public function help()
	{
		return view('site.help');
	}

    public function team()
    {
        $teammates = Person::where('type', 'team')->orderBy('name')->get();
        return view('site.team', [
			'teammates' => $teammates,
			'title' => 'Quem Somos'
		]);
    }

    public function partners()
    {
        $partners = Person::where('type', 'partner')->orderBy('name')->get();
        return view('site.partners', [
			'partners' => $partners,
			'title' => 'Parceiros'
		]);
	}
	
	public function events()
	{
		$nextEvent = Event::where('date', '>=', date('Y-m-d'))->orderBy('date', 'asc')->first();
		$events = Event::where('date', '>=', date('Y-m-d'))->orderBy('date', 'asc')->skip(1)->take($this->eventsAmount)->get();
		return view('site.events', [
			'nextEvent' => $nextEvent,
			'events' => $events,
			'title' => 'Eventos',
			'description' => 'Veja o próximo eventos sobre prevenção do aliciamento de crianças e adolescentes'
		]);
	}

	public function runArtisanCommand($command)
	{
		if ($command === 'migrate') {
			Artisan::call('migrate');
			return 'Migration executada!';
		} else if ($command === 'seed') {
			if (User::count() === 0) {
				Artisan::call('db:seed');
				return 'Seed executado!';
			}
			return 'Seed não executado! Já foram encontrados usuários na base de dados.';
		}
		return 'Comando inválido!';
	}

}
