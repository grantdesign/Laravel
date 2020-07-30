<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Page;

class PagesEditController extends Controller
{
    public function execute(Page $page, Request $request)
    {
    	if ($request->isMethod('delete')) {
    		
    		$page->delete(); // удаление записи

            unlink(public_path().'/assets/img/'.$page->images); // удаление файла

    		return redirect()->route('pages')->with('status', 'Страница удалена');

    	}

    	if ($request->isMethod('post')) {
    		
    		$input = $request->except('_token'); // вытащить все данные кроме токена

    		$messages = [
    			'required' => 'Поле :attribute обязательно для заполнения',
    			'unique' => 'Поле :attribute должно быть уникальным',
                'image' => 'Поле :attribute не содержит изображение',
    		];

    		$validator = Validator::make($input, [
    			'name' => 'required|max:100',
    			'alias' => 'required|max:100|unique:pages,alias,'.$page->id, // игнор уникальной записи при редактировании записи
    			'content' => 'required',
                'images' => 'image',
    		], $messages);

    		if ($validator->fails()) {
    			return redirect()->route('pagesEdit', $page->id)->withErrors($validator);
    		}

    		if ($request->hasFile('images')) {

    			unlink(public_path().'/assets/img/'.$input['old_images']); // удаление старой картинки

    			$file = $request->file('images'); // получение объекта файл

    			$input['images'] = $file->getClientOriginalName(); // оригинальное имя для файла

    			$file->move(public_path().'/assets/img', $input['images']); // сохранение файла в папке

    		} else {
    			$input['images'] = $input['old_images'];
    		}

    		unset($input['old_images']);

    		$page->fill($input);

    		if ($page->save()) {
    			return redirect()->route('pages')->with('status', 'Страница обновлена');
    		}
    	
    	}

    	if (!view()->exists('admin.pages_edit')) abort(404);

    	return view('admin.pages_edit', [
    		'title' => 'Редактирование страницы',
    		'page' => $page,
    	]);
    }
}
