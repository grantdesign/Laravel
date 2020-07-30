<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form action="{{ route('pagesAdd') }}" method="post" enctype="multipart/form-data">
					@csrf
					<label for="name">Название</label>
					<input type="text" id="name" class="form-control" name="name" placeholder="Введите название" value="{{ old('name') }}"><br>
					<label for="alias">Псевдоним</label>
					<input type="text" id="alias" class="form-control" name="alias" placeholder="Введите псевдоним" value="{{ old('alias') }}"><br>
					<label for="text">Текст</label>
					<textarea name="content" id="editor" class="form-control">{{ old('text') }}</textarea><br>
					<label for="images">Изображение</label>
					<input type="file" id="images" class="filestyle data-ButtonText" name="images"><br>
					<button type="submit" class="btn btn-success">Добавить</button>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>