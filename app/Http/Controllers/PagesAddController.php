<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Page;

class PagesAddController extends Controller
{
    public function execute(Request $request)
    {
    	if ($request->isMethod('post')) {
    		
    		$input = $request->except('_token'); // вытащить все данные кроме токена

    		$messages = [
    			'required' => 'Поле :attribute обязательно для заполнения',
    			'unique' => 'Поле :attribute должно быть уникальным',
    			'image' => 'Поле :attribute не содержит изображение',
    		];

    		$validator = Validator::make($input, [
    			'name' => 'required|max:100',
    			'alias' => 'required|unique:pages|max:100',
    			'content' => 'required',
    			'images' => 'required|image',
    		], $messages);

    		if ($validator->fails()) {
    			return redirect()->route('pagesAdd')->withErrors($validator)->withInput(); // редирект и сохранение данных в сессию (old)
    		}

    		if ($request->hasFile('images')) {

    			$file = $request->file('images'); // получение объекта файл

    			$input['images'] = $file->getClientOriginalName(); // оригинальное имя для файла

    			$file->move(public_path().'/assets/img', $input['images']); // сохранение файла в папке

    		}

    		$page = new Page;

    		$page->fill($input); // добавление данных в модель Page и нужно прописать закрытое свойство fillable в модели Page

    		if ($page->save()) {
    			return redirect()->route('pages')->with('status', 'Страница добавлена');
    		}

    	}

    	if (!view()->exists('admin.pages_add')) abort(404);

    	return view('admin.pages_add', [
    		'title' => 'Добавление страницы',
    	]);
    }
}
