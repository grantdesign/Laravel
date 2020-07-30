<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;
use App\Service;
use App\Portfolio;
use App\People;

Use DB;

Use Mail;

class IndexController extends Controller
{
    public function execute(Request $request)
    {
    	if ($request->isMethod('post')) {

    		$messages = [
    			'required' => 'Поле :attribute обязательно для заполнения',
    			'email' => 'Поле :attribute содержит некорректный адрес',
    		];

    		$this->validate($request, [
    			'name' => 'required|max:255',
    			'email' => 'required|email',
    			'text' => 'required',
    		], $messages);

    		$data = $request->all();

    		$result = mail(env('MAIL_FROM_ADDRESS'), 'Question', $data['text']); // mail

    		if ($result) {
    			return redirect()->route('home')->with('status', 'Email is send');
    		}

    	}

    	$pages = Page::all();
    	$services = Service::where('id', '<', 20)->get();
    	$portfolios = Portfolio::get(['name', 'images', 'filter']);
    	$peoples = People::take(3)->get();

    	$tags = DB::table('portfolios')->distinct()->pluck('filter');

    	$menu = [];

    	foreach ($pages as $key => $page) {
    		$item = ['title' => $page->name, 'alias' => $page->alias];
    		array_push($menu, $item);
    	}

    	$item = ['title' => 'services', 'alias' => 'service'];
    	array_push($menu, $item);

    	$item = ['title' => 'portfolio', 'alias' => 'portfolio'];
    	array_push($menu, $item);

    	$item = ['title' => 'team', 'alias' => 'team'];
    	array_push($menu, $item);

    	$item = ['title' => 'contact', 'alias' => 'contact'];
    	array_push($menu, $item);

    	return view('site.index', [
    		'title' => 'Unique',
    		'menu' => $menu,
    		'pages' => $pages,
    		'services' => $services,
    		'portfolios' => $portfolios,
    		'peoples' => $peoples,
    		'tags' => $tags,
    	]);
    }
}
