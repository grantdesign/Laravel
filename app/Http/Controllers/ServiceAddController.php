<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Service;

class ServiceAddController extends Controller
{
    public function execute(Request $request)
    {
    	if ($request->isMethod('post')) {
    		
    		$input = $request->except('_token');

    		$messages = [
    			'required' => 'Поле :attribute обязательно для заполнения',
    		];

    		$validator = Validator::make($input, [
    			'name' => 'required|max:100',
    			'icon' => 'required|max:100',
    			'text' => 'required',
    		], $messages);

    		if ($validator->fails()) return redirect()->route('serviceAdd')->withErrors($validator)->withInput();

    		$service = new Service;

    		$service->fill($input);

    		if ($service->save()) return redirect()->route('services')->with('status', 'Сервис добавлен');

    	}

    	if (!view()->exists('admin.services_add')) abort(404);

    	return view('admin.services_add', [
    		'title' => 'Добавление сервиса',
    	]);
    }
}
