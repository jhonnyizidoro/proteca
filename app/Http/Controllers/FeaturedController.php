<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeaturedController extends Controller
{
	public function showFeatured()
	{
		return view('admin.featured');
	}
}
