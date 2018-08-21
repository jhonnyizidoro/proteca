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

    public function showEvents()
    {
        return view('admin.events');
    }

}
