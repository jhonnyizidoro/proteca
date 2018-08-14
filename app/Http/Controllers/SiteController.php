<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home');
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

    public function posts()
    {
        return view('admin.posts');
    }

    public function people()
    {
        return view('admin.people');
    }

}
