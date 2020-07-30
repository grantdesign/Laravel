<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Service;

class ServiceEditController extends Controller
{
    public function execute(Service $service, Request $request)
    {
    	if ($request->isMethod('delete')) {
    		
    		$service->delete();

    		return redirect()->route('services')->with('status', 'Сервис удален');

    	}

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

    		$service->fill($input);

    		if ($service->save()) return redirect()->route('services')->with('status', 'Сервис обновлен');

    	}

    	if (!view()->exists('admin.services_edit')) abort(404);

    	return view('admin.services_edit', [
    		'title' => 'Редактирование сервиса',
    		'service' => $service,
    	]);
    }
}
