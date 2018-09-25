<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Person;
use App\Work;

class SiteController extends Controller
{

    private $postsPageSize = 5;

    public function home()
    {
        $featureds = Post::orderBy('created_at', 'desc')->take(3)->get();
        $newposts = Post::orderBy('created_at', 'desc')->take(5)->get();
        $works = Work::orderBy('created_at', 'desc')->take(10)->get();
        return view('site.home')
            ->with('featureds', $featureds)
            ->with('newposts', $newposts)
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

    public function works()
    {
		$books = Work::whereHas('category', function($q){
			$q->where('category', 'Livros');
		})->orderBy('title')->get();
		$articles = Work::whereHas('category', function($q){
			$q->where('category', 'Artigos');
		})->orderBy('title')->get();
		$charts = Work::whereHas('category', function($q){
			$q->where('category', 'Cartilhas');
		})->orderBy('title')->get();
		$laws = Work::whereHas('category', function($q){
			$q->where('category', 'Leis');
		})->orderBy('title')->get();
		$reviews = Work::whereHas('category', function($q){
			$q->where('category', 'Resenhas');
		})->orderBy('title')->get();
		$others = Work::whereHas('category', function($q){
			$q->where('category', 'Outros');
		})->orderBy('title')->get();

		return view('site.works')
			->with('books', $books)
			->with('articles', $articles)
			->with('laws', $laws)
			->with('reviews', $reviews)
			->with('others', $others)
			->with('charts', $charts);
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

}
