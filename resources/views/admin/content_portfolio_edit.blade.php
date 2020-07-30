@if(isset($portfolio))
<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form action="{{ route('portfolioEdit', $portfolio->id) }}" method="post" enctype="multipart/form-data">
				@csrf
				<label for="name">Название</label>
				<input type="text" id="name" class="form-control" name="name" placeholder="Введите название" value="{{ $portfolio->name }}"><br>
				<label for="filter">Фильтр</label>
				<select class="form-control" name="filter" id="filter">
					@foreach($filters as $key => $filter)
						@if($filter->name == $selected)
						<option selected="selected" value="{{ $filter->name }}">{{ $filter->name }}</option>
						@else
						<option value="{{ $filter->name }}">{{ $filter->name }}</option>
						@endif
					@endforeach
				</select><br>
				<div class="form-group">
					<label>Старое изображение</label><br>
					<img src="{{ asset('assets/img/'.$portfolio->images) }}" width="117">
					<input type="hidden" name="old_images" value="{{ $portfolio->images }}">
				</div>
				<label for="images">Новое изображение</label>
				<input type="file" id="images" name="images" class="filestyle data-ButtonText"><br>
				<button type="submit" class="btn btn-success">Сохранить</button>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>
@endif