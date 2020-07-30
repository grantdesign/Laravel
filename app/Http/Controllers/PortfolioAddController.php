<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Filter;
use App\Portfolio;

class PortfolioAddController extends Controller
{
    public function execute(Request $request)
    {
    	if ($request->isMethod('post')) {

    		$input = $request->except('_token'); // вытащить все данные кроме токена

    		$messages = [
    			'required' => 'Поле :attribute обязательно для заполнения',
    			'image' => 'Поле :attribute не содержит изображение',
    		];
    		
    		$validator = validator::make($input, [
    			'name' => 'required|max:200',
    			'images' => 'required|image',
    		], $messages);

    		if ($validator->fails()) {
    			return redirect()->route('portfolioAdd')->withErrors($validator)->withInput();
    		}

    		if ($request->hasFile('images')) {

    			$file = $request->file('images'); // получение объекта файл

    			$input['images'] = $file->getClientOriginalName(); // оригинальное имя для файла

    			$file->move(public_path().'/assets/img', $input['images']); // сохранение файла в папке

    		}

    		$portfolio = new Portfolio;

    		$portfolio->fill($input); // добавление данных в модель и нужно прописать закрытое свойство fillable в модели

    		if ($portfolio->save()) {
    			return redirect()->route('portfolio')->with('status', 'Портфолио добавлено');
    		}

    	}

    	if (!view('admin.portfolio_add')) abort(404);

    	$filters = Filter::select('name')->get();

    	return view('admin.portfolio_add', [
    		'title' => 'Добавление портфолио',
    		'filters' => $filters,
    	]);
    }
}
