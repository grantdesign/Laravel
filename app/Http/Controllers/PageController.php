<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Page;

class PageController extends Controller
{
    public function execute($alias)
    {
    	if (!$alias) abort(404);

    	$page = Page::where('alias', strip_tags($alias))->first();

    	if (!$page) abort(404);

    	$data = [
    		'title' => $page->name,
    		'page' => $page,
    	];

    	if (view()->exists('site.page')) {
    		return view('site.page', $data);
    	}

    	else abort(404);
    }
}
