@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Home
@stop


@section('css')

<link rel="stylesheet" href="{{ asset('assets/styles/css/colleges.css')}} ">

@stop


@section('content')

<h3>Books by {{{ $user->firstName() }}}</h3>


<a href="{{ URL::to('bookshelf/user/'.$user->id) }}"><h4>Bookshelf</h4></a>
<?php if(isset($bookshelf['0'])): ?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
				<th>Book Name</th>
				<th>Author</th>
				<th>Price</th>
				<th>Status</th>
				<th>Available</th>
				<th>Condition</th>
                <th>Location</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($bookshelf as $bookshelf)
                <tr>
					<td><a href="{{ URL::to('bookshelf/'.$bookshelf->id) }}">{{{ $bookshelf->name }}}</a></td>
					<td>{{{ $bookshelf->author }}}</td>
					<td>{{{ $bookshelf->price }}}</td>
					<td>{{{ $bookshelf->status }}}</td>
					<td>{{{ $bookshelf->available }}}</td>
                    <td>{{{ $bookshelf->condition }}}</td>
<td>
<?php 
$colle = DB::table('colleges')->where('id', 'like', $bookshelf->collegeid)->get();
echo '<a href="'.URL::to('colleges/'.$colle['0']->id) .'">'.$colle['0']->name.'</a>'; 
?>
</td>

					@if(Auth::user()->id == $bookshelf->userid)
                    <td>{{ link_to_route('bookshelf.edit', 'Edit', array($bookshelf->id), array('class' => 'btn btn-info')) }}</td>
                    
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('bookshelf.destroy', $bookshelf->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
<?php else: ?>
    No Books found. <?php echo link_to_route('bookshelf.create', 'Add a Book to your Bookshelf'); ?>

<?php endif; ?>

<a href="{{ URL::to('wishlist/user/'.$user->id) }}"><h4>Wishlist</h4></a>
<?php if(isset($wishlist['0'])): ?>
	
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
				<th>Book Name</th>
				<th>Author</th>
				<th>Price</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($wishlist as $wishlist)
                <tr>
					<td><a href="{{ URL::to('wishlist/'.$wishlist->id) }}">{{{ $wishlist->name }}}</a></td>
					<td>{{{ $wishlist->author }}}</td>
					<td>{{{ $wishlist->price }}}</td>

					@if(Auth::user()->id == $wishlist->userid)
                    <td>{{ link_to_route('wishlist.edit', 'Edit', array($wishlist->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('wishlist.destroy', $wishlist->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
<?php else: ?>
    No Books found. <?php echo link_to_route('wishlist.create', 'Add a Book to your Wishlist'); ?>
<?php endif; ?>

@stop