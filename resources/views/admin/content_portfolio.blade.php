@if(isset($portfolios))
<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>№</th>
						<th>Название</th>
						<th>Изображение</th>
						<th>Фильтр</th>
						<th style="padding-left: 115px;" colspan="2">Действие</th>
					</tr>
				</thead>
				<tbody>
					@foreach($portfolios as $key => $portfolio)
					<tr>
						<td>{{ $num++ }}</td>
						<td>{{ $portfolio->name }}</td>
						<td>{{ $portfolio->images }}</td>
						<td>{{ $portfolio->filter }}</td>
						<td>
							<a href="{{ route('portfolioEdit', $portfolio->id) }}"><button class="btn btn-primary">Изменить</button></a>
						</td>
						<td>
							<form action="{{ route('portfolioEdit', $portfolio->id) }}" method="post">
								@csrf
								@method('DELETE')
								<a href="{{ route('portfolioEdit', $portfolio->id) }}"><button class="btn btn-danger">Удалить</button></a>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-1"></div>
		<a href="{{ route('portfolioAdd') }}"><button class="btn btn-success">Добавить портфолио</button></a>
	</div>
</div>
@endif