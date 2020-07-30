<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;

class PagesController extends Controller
{
    public function execute()
    {
    	if (!view()->exists('admin.pages')) abort(404);

    	$pages = Page::all();

    	$data = [
    		'title' => 'Страницы',
    		'num' => 1,
    		'pages' => $pages,
    	];

    	return view('admin.pages', $data);
    }
}
