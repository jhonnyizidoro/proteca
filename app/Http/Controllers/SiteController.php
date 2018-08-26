<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;

class SiteController extends Controller
{
    public function home()
    {
        $featureds = Post::orderBy('created_at', 'desc')->take(3)->get();
        $newposts = Post::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.home')
            ->with('featureds', $featureds)
            ->with('newposts', $newposts);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }

    public function admin()
    {
        return redirect()->route('admin.posts');
    }

}
