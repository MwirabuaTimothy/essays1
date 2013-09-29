@extends('layouts.scaffold')

@section('main')

<h1>Create Order</h1>

{{ Form::open(array('route' => 'orders.store')) }}
	<ul>
        <li>
            {{ Form::label('topic', 'Topic:') }}
            {{ Form::text('topic') }}
        </li>

        <li>
            {{ Form::label('instructions', 'Instructions:') }}
            {{ Form::text('instructions') }}
        </li>

        <li>
            {{ Form::label('subject', 'Subject:') }}
            {{ Form::text('subject') }}
        </li>

        <li>
            {{ Form::label('doctype', 'Doctype:') }}
            {{ Form::text('doctype') }}
        </li>

        <li>
            {{ Form::label('pages', 'Pages:') }}
            {{ Form::text('pages') }}
        </li>

        <li>
            {{ Form::label('single_paced', 'Single_paced:') }}
            {{ Form::checkbox('single_paced') }}
        </li>

        <li>
            {{ Form::label('style', 'Style:') }}
            {{ Form::text('style') }}
        </li>

        <li>
            {{ Form::label('academic_level', 'Academic_level:') }}
            {{ Form::text('academic_level') }}
        </li>

        <li>
            {{ Form::label('page_cost', 'Page_cost:') }}
            {{ Form::text('page_cost') }}
        </li>

        <li>
            {{ Form::label('total', 'Total:') }}
            {{ Form::text('total') }}
        </li>

        <li>
            {{ Form::label('currency', 'Currency:') }}
            {{ Form::text('currency') }}
        </li>

        <li>
            {{ Form::label('language', 'Language:') }}
            {{ Form::text('language') }}
        </li>

        <li>
            {{ Form::label('urgency', 'Urgency:') }}
            {{ Form::text('urgency') }}
        </li>

        <li>
            {{ Form::label('recieve_calls', 'Recieve_calls:') }}
            {{ Form::checkbox('recieve_calls') }}
        </li>

        <li>
            {{ Form::label('status', 'Status:') }}
            {{ Form::text('status') }}
        </li>

        <li>
            {{ Form::label('notes', 'Notes:') }}
            {{ Form::text('notes') }}
        </li>

		<li>
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


