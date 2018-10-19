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
		$mainFeaturedVideo = FeaturedVideo::where('main', true)->first();
	    $featuredVideos = FeaturedVideo::where('main', '!=', true)->get();
		$featuredPosts = FeaturedPost::get();
		return view('admin.featured', [
			'featuredVideos' => $featuredVideos,
			'featuredPosts' => $featuredPosts,
			'mainFeaturedVideo' => $mainFeaturedVideo,
		]);
	}

	public function createFeaturedPost(NewFeaturedPostRequest $request)
	{
		$postUrl = explode('/', $request->url);
		$postUrl = end($postUrl);
		if ($post = Post::where('url', $postUrl)->first()) {
			FeaturedPost::create([
				'post_id' => $post->id
			]);
			return redirect()->back()->with('status', 'Notícia adicionada aos destaques.');
		}
		return redirect()->back()->withErrors('Não foi encontrada nenhuma notícia referente ao link inserido.');
	}

	public function createFeaturedVideo(NewFeaturedVideoRequest $request)
	{
		if ($title = self::getYoutubeTitleFromUrl($request->video_url)) {
			if ($request->main == 1) {
				FeaturedVideo::where('main', true)->update(['main' => false]);
			}
			FeaturedVideo::create([
				'main' => $request->main == 1 ? true : false,
				'title' => $title,
				'url' => $request->video_url
			]);
			return redirect()->back()->with('status', 'Vídeo em destaque adicionado com sucesso.');
		}
		return redirect()->back()->withErrors('O link para o vídeo informado é invalido. Certifique-se de que se trata de um vídeo do youtube.');
		
	}

	public function deleteFeaturedPost($id)
	{
		$featuredPost = FeaturedPost::where('id', $id)->delete();
		return redirect()->back()->with('status', 'Destaque removido com sucesso.');
	}

	public function deleteFeaturedVideo($id)
	{
		$featuredVideot = FeaturedVideo::where('id', $id)->delete();
		return redirect()->back()->with('status', 'Destaque removido com sucesso.');
	}

	public static function getYoutubeTitleFromUrl($url)
	{
		$urlParts = parse_url($url);
		if ($urlParts['host'] == 'www.youtube.com' && isset($urlParts['query'])) {
			parse_str($urlParts['query'], $urlParameters);
			if (isset($urlParameters['v'])) {
				$videoContent = file_get_contents("http://youtube.com/get_video_info?video_id=".$urlParameters['v']);
				parse_str($videoContent, $videoInformation);
				return $videoInformation['title'];
			}
		}
		return false;
	}

}
