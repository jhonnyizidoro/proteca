<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewFeaturedPostRequest;
use App\Http\Requests\NewFeaturedVideoRequest;
use App\Models\SiteContent\FeaturedPost;
use App\Models\SiteContent\FeaturedVideo;
use App\Models\Post;

class FeaturedController extends Controller
{
	public function showFeatured()
	{
	    $featuredVideos = FeaturedVideo::get();
		$featuredPosts = FeaturedPost::get();
		return view('admin.featured')->with('featuredVideos', $featuredVideos)->with('featuredPosts', $featuredPosts);
	}

	public function createFeaturedPost(NewFeaturedPostRequest $request)
	{
		$postUrl = explode('/', $request->url);
		$postUrl = end($postUrl);
		if ($post = Post::where('url', $postUrl)->first()) {
			if (!FeaturedPost::where('post_id', $post->id)->first()){
				FeaturedPost::create([
					'post_id' => $post->id
				]);
				return redirect()->back()->with('status', 'Notícia adicionada aos destaques.');
			}
			return redirect()->back()->with('status', 'Essa notícia já está em destaque.');
		}
		return redirect()->back()->withErrors('Não foi encontrada nenhuma notícia referente ao link inserido.');
	}

	public function deleteFeaturedPost($id)
	{
		$featuredPost = FeaturedPost::where('id', $id)->delete();
		return redirect()->back()->with('status', 'Destaque removido com sucesso.');
	}

}
