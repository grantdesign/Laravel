<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Portfolio;

class PortfolioController extends Controller
{
    public function execute()
    {
    	if (!view()->exists('admin.portfolio')) abort(404);

    	$portfolios = Portfolio::all();

    	return view('admin.portfolio', [
    		'title' => 'Портфолио',
    		'num' => 1,
    		'portfolios' => $portfolios,
    	]);
    }
}
