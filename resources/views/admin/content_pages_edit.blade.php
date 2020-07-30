<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form action="{{ route('pagesEdit', $page->id) }}" method="post" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="id" value="{{ $page->id }}">
					<label for="name">Название</label>
					<input type="text" id="name" class="form-control" name="name" placeholder="Введите название" value="{{ $page->name }}"><br>
					<label for="alias">Псевдоним</label>
					<input type="text" id="alias" class="form-control" name="alias" placeholder="Введите псевдоним" value="{{ $page->alias }}"><br>
					<label for="text">Текст</label>
					<textarea name="content" id="editor" class="form-control">{{ $page->content }}</textarea><br>
					<div class="form-group">
						<label>Старое изображение</label><br>
						<img src="{{ asset('assets/img/'.$page->images) }}" alt="{{ $page->images }}" width="183">
						<input type="hidden" name="old_images" value="{{ $page->images }}">
					</div>
					<label for="images">Новое изображение</label>
					<div class="form-group">
						<input type="file" id="images" class="filestyle data-ButtonText" name="images"><br>
						<button type="submit" class="btn btn-success">Сохранить</button>
					</div>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>