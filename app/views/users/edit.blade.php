@extends('layouts.scaffold')

@section('main')

<h1>Edit User</h1>
{{ Form::model($user, array('method' => 'PATCH', 'route' => array('users.update', $user->id))) }}
	<ul>
        <li>
            {{ Form::label('fname', 'Fname:') }}
            {{ Form::text('fname') }}
        </li>

        <li>
            {{ Form::label('lname', 'Lname:') }}
            {{ Form::text('lname') }}
        </li>

        <li>
            {{ Form::label('uname', 'Uname:') }}
            {{ Form::text('uname') }}
        </li>

        <li>
            {{ Form::label('email', 'Email:') }}
            {{ Form::text('email') }}
        </li>

        <li>
            {{ Form::label('password', 'Password:') }}
            {{ Form::text('password') }}
        </li>

        <li>
            {{ Form::label('role', 'Role:') }}
            {{ Form::text('role') }}
        </li>

        <li>
            {{ Form::label('country', 'Country:') }}
            {{ Form::text('country') }}
        </li>

        <li>
            {{ Form::label('phone_1', 'Phone_1:') }}
            {{ Form::text('phone_1') }}
        </li>

        <li>
            {{ Form::label('phone_2', 'Phone_2:') }}
            {{ Form::text('phone_2') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('users.show', 'Cancel', $user->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
