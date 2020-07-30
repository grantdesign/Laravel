@if(isset($service))
<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form action="{{ route('serviceEdit', $service->id) }}" method="post">
				@csrf
				<label for="name">Название</label>
				<input type="text" name="name" id="name" class="form-control" placeholder="Введите название" value="{{ $service->name }}"><br>
				<label for="icon">Иконка</label>
				<input type="text" name="icon" id="icon" class="form-control" placeholder="fa-apple" value="{{ $service->icon }}"><br>
				<label for="text">Текст</label>
				<textarea name="text" id="text" class="form-control" cols="30" rows="10">{{ $service->text }}</textarea><br>
				<button type="submit" class="btn btn-success">Сохранить</button>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>
@endif