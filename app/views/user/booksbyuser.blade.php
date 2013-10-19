@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Books
@stop


@section('css')

<link rel="stylesheet" href="{{ asset('assets/styles/css/mybooks.css')}} ">

@stop


@section('content')

<h2 class="gradient-title">{{{ $title }}}</h2>

<fieldset>
<legend>
    <a href="{{ URL::to('bookshelf/user/'.$user->id) }}"> <h3 class="gradient-yellow">Bookshelf</h3></a>
</legend>

{{ User::addBook($user->id, 'bookshelf') }}

<?php if(isset($bookshelf['0'])): ?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
				<th>Cover</th>
				<th>Title</th>
                <th>Potential Local Buyers</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($bookshelf as $bookshelf)
                <tr>

					<td rowspan="">
                        <a href="{{ URL::to('bookshelf/'.$bookshelf->id) }}"><img src="{{{ $bookshelf->imgurl }}}" /></a>
                    </td>
                    
					<td><a href="{{ URL::to('bookshelf/'.$bookshelf->id) }}">{{{ $bookshelf->name }}}</a></td>
					<td>0</td>
                    <td>
                            <a href="{{ $bookshelf->bookurl }}" class="btn btn-warning">On Amazon</a>
                        <br/>
                            {{ User::editButton($bookshelf->userid, 'bookshelf', $bookshelf->id) }}
                        <br/>
                            {{ User::deleteButton($bookshelf->userid, 'bookshelf', $bookshelf->id) }}
                    </td>
					
                </tr>
            @endforeach
        </tbody>
    </table>
<?php else: ?>
    No Books found.

<?php endif; ?>

</fieldset>

<fieldset>
<legend>
    <a href="{{ URL::to('wishlist/user/'.$user->id) }}"><h3 class="gradient-yellow">Wishlist</h3></a>
</legend>

{{ User::addBook($user->id, 'wishlist') }}

<?php if(isset($wishlist['0'])): ?>
	
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
				<th>Cover</th>
                <th>Title</th>
                <th>Potential Local Sellers</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($wishlist as $wishlist)
                <tr>
					<td>
                        <a href="{{ URL::to('bookshelf/'.$bookshelf->id) }}"><img src="{{{ $wishlist->imgurl }}}" /></a>
                    </td>
                    <td><a href="{{ URL::to('wishlist/'.$wishlist->id) }}">{{{ $wishlist->name }}}</a></td>
                    <td>0</td>
                    <td>
                            <a href="{{ $wishlist->bookurl }}" class="btn btn-warning">On Amazon</a>
                        <br/>
                            {{ User::editButton($wishlist->userid, 'wishlist', $wishlist->id) }}
                        <br/>
                            {{ User::deleteButton($wishlist->userid, 'wishlist', $wishlist->id) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
<?php else: ?>
    No Books found.
<?php endif; ?>
</fieldset>


@stop
