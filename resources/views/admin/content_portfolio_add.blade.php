<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form action="{{ route('portfolioAdd') }}" method="post" enctype="multipart/form-data">
				@csrf
				<label for="name">Название</label>
				<input type="text" id="name" class="form-control" name="name" placeholder="Введите название" value="{{ old('name') }}"><br>
				<label for="filter">Фильтр</label>
				<select class="form-control" name="filter" id="filter">
					@foreach($filters as $key => $filter)
					<option value="{{ $filter->name }}">{{ $filter->name }}</option>
					@endforeach
				</select><br>
				<label for="images">Изображение</label>
				<input type="file" id="images" name="images" class="filestyle data-ButtonText"><br>
				<button type="submit" class="btn btn-success">Добавить</button>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>