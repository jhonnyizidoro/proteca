<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Person;
use App\Work;

class SiteController extends Controller
{
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

    public function post($url)
    {
        $post = Post::where('url', $url)->first();
        return view('site.post')->with('post', $post);
    }

    public function team()
    {
        $teammates = Person::where('type', 'team')->get();
        return view('site.team')->with('teammates', $teammates);
    }

    public function partners()
    {
        $partners = Person::where('type', 'partner')->get();
        return view('site.partners')->with('partners', $partners);
    }

}
