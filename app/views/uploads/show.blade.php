@extends('layouts.scaffold')

@section('main')

<h1>Show Upload</h1>

<p>{{ link_to_route('uploads.index', 'Return to all uploads') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Url</th>
				<th>Title</th>
				<th>Order_id</th>
				<th>User_id</th>
				<th>Downloads</th>
				<th>Category</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $upload->url }}}</td>
					<td>{{{ $upload->title }}}</td>
					<td>{{{ $upload->order_id }}}</td>
					<td>{{{ $upload->user_id }}}</td>
					<td>{{{ $upload->downloads }}}</td>
					<td>{{{ $upload->category }}}</td>
                    <td>{{ link_to_route('uploads.edit', 'Edit', array($upload->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('uploads.destroy', $upload->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
