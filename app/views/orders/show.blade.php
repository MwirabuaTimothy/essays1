@extends('layouts.scaffold')

@section('main')

<h1>Show Order</h1>

<p>{{ link_to_route('orders.index', 'Return to all orders') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Topic</th>
				<th>Instructions</th>
				<th>Subject</th>
				<th>Doctype</th>
				<th>Pages</th>
				<th>Single_paced</th>
				<th>Style</th>
				<th>Academic_level</th>
				<th>Page_cost</th>
				<th>Total</th>
				<th>Currency</th>
				<th>Language</th>
				<th>Urgency</th>
				<th>Recieve_calls</th>
				<th>Status</th>
				<th>Notes</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $order->topic }}}</td>
					<td>{{{ $order->instructions }}}</td>
					<td>{{{ $order->subject }}}</td>
					<td>{{{ $order->doctype }}}</td>
					<td>{{{ $order->pages }}}</td>
					<td>{{{ $order->single_paced }}}</td>
					<td>{{{ $order->style }}}</td>
					<td>{{{ $order->academic_level }}}</td>
					<td>{{{ $order->page_cost }}}</td>
					<td>{{{ $order->total }}}</td>
					<td>{{{ $order->currency }}}</td>
					<td>{{{ $order->language }}}</td>
					<td>{{{ $order->urgency }}}</td>
					<td>{{{ $order->recieve_calls }}}</td>
					<td>{{{ $order->status }}}</td>
					<td>{{{ $order->notes }}}</td>
                    <td>{{ link_to_route('orders.edit', 'Edit', array($order->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('orders.destroy', $order->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
