<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form action="{{ route('serviceAdd') }}" method="post">
				@csrf
				<label for="name">Название</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="Введите название" value="{{ old('name') }}"><br>
				<label for="icon">Иконка</label>
				<input type="text" name="icon" id="icon" class="form-control" placeholder="fa-apple" value="{{ old('icon') }}"><br>
				<label for="text">Текст</label>
				<textarea name="text" id="text" class="form-control" cols="30" rows="10">{{ old('text') }}</textarea><br>
				<button type="submit" class="btn btn-success">Добавить</button>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>