<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service;

class ServiceController extends Controller
{
    public function execute()
    {
    	if (!view()->exists('admin.services')) abort(404);

    	$services = Service::all();

    	return view('admin.services', [
    		'title' => 'Сервисы',
    		'num' => 1,
    		'services' => $services,
    	]);
    }
}
