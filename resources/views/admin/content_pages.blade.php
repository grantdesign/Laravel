<div style="margin:0px 50px 0px 50px;">   

@if(isset($pages))
	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th>№</th>
				<th>Имя</th>
				<th>Псевдоним</th>
				<th>Текст</th>
				<th class="text-center" colspan="2">Действие</th>
			</tr>
		</thead>
		<tbody>
			@foreach($pages as $key => $page)
			<tr>
				<td>{{ $num++ }}</td>
				<td><a href="{{ route('page', $page->alias) }}">{{ $page->name }}</a></td>
				<td>{{ $page->alias }}</td>
				<td>{{ $page->content }}</td>
				<td><a href="{{ route('pagesEdit', $page->id) }}"><button type="button" class="btn btn-primary">Изменить</button></a></td>
				<form action="{{ route('pagesEdit', $page->id) }}" method="post">
					@csrf
					@method('DELETE')
					<td><a href="{{ route('pagesEdit', $page->id) }}"><button type="submit" class="btn btn-danger">Удалить</button></a></td>
				</form>
			</tr>
			@endforeach
		</tbody>
	</table>
@endif

<a href="{{ route('pagesAdd') }}"><button class="btn btn-success">Новая страница</button></a>
</div>