<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Filter;
use App\Portfolio;

class PortfolioEditController extends Controller
{
    public function execute(Portfolio $portfolio, Request $request)
    {
    	if ($request->isMethod('delete')) {

    		$portfolio->delete();

    		unlink(public_path().'/assets/img/'.$portfolio->images); // удаление файла

    		return redirect()->route('portfolio')->with('status', 'Портфолио удалено');

    	}

    	if ($request->isMethod('post')) {
    		
    		$input = $request->except('_token'); // вытащить все данные кроме токена

    		$messages = [
    			'required' => 'Поле :attribute обязательно для заполнения',
    			'image' => 'Поле :attribute не содержит изображение',
    		];
    		
    		$validator = Validator::make($input, [
    			'name' => 'required|max:200',
    			'images' => 'image',
    		], $messages);

    		if ($validator->fails()) {
    			return redirect()->route('portfolioEdit', $portfolio->id)->withErrors($validator);
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

    		$portfolio->fill($input);

    		if ($portfolio->save()) {
    			return redirect()->route('portfolio')->with('status', 'Портфолио обновлено');
    		}

    	}

    	if (!view()->exists('admin.portfolio_edit')) abort(404);

    	$filters = Filter::select('name')->get();

    	return view('admin.portfolio_edit', [
    		'title' => 'Редактирование портфолио',
    		'filters' => $filters,
    		'selected' => $portfolio->filter,
    		'portfolio' => $portfolio,
    	]);
    }
}
