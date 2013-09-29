@extends('layouts.scaffold')

@section('main')

<h1>Show User</h1>

<p>{{ link_to_route('users.index', 'Return to all users') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Fname</th>
				<th>Lname</th>
				<th>Uname</th>
				<th>Email</th>
				<th>Password</th>
				<th>Role</th>
				<th>Country</th>
				<th>Phone_1</th>
				<th>Phone_2</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $user->fname }}}</td>
					<td>{{{ $user->lname }}}</td>
					<td>{{{ $user->uname }}}</td>
					<td>{{{ $user->email }}}</td>
					<td>{{{ $user->password }}}</td>
					<td>{{{ $user->role }}}</td>
					<td>{{{ $user->country }}}</td>
					<td>{{{ $user->phone_1 }}}</td>
					<td>{{{ $user->phone_2 }}}</td>
                    <td>{{ link_to_route('users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('users.destroy', $user->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
