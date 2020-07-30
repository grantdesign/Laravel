@if(isset($services))
<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>№</th>
						<th>Имя</th>
						<th>Текст</th>
						<th>Иконка</th>
						<th class="text-center" colspan="2">Действие</th>
					</tr>
				</thead>
				<tbody>
					@foreach($services as $key => $service)
					<tr>
						<td>{{ $num++ }}</td>
						<td>{{ $service->name }}</td>
						<td>{{ $service->text }}</td>
						<td>{{ $service->icon }}</td>
						<td>
							<a href="{{ route('serviceEdit', $service->id) }}"><button class="btn btn-primary">Изменить</button></a>
						</td>
						<td>
							<form action="{{ route('serviceEdit', $service->id) }}" method="post">
								@csrf
								@method('DELETE')
								<a href="{{ route('serviceEdit', $service->id) }}"><button class="btn btn-danger">Удалить</button></a>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-1"></div>
		<a href="{{ route('serviceAdd') }}"><button class="btn btn-success">Добавить сервис</button></a>
	</div>
</div>
@endif