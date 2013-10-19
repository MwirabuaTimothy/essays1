@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Edit your Account
@stop


@section('css')

 <link rel="stylesheet" href="{{ asset('assets/styles/css/register-edit.css')}} ">

@stop

@section('js')

<!-- SimpleModal and Basic JS files -->
<script src="{{ asset('assets/scripts/js/plugins.js') }}"></script>
<script src="{{ asset('assets/scripts/js/jquery.simplemodal.js') }}"></script>

<script src="{{ asset('assets/scripts/js/basic.js') }}"></script>
 

<script type="text/javascript">

$('form .control-group span.whyschool').on('click', function(){

	if($('#modal-content').css('display') == 'none'){
		$('#modal-content').css('display', 'inline');
	}
	else{
		$('#modal-content').css('display', 'none');
	}
	
});

$('form .control-group #terms').on('click', function(){
	if($(this).attr("value") == "0"){
		$(this).attr("value", "1");
	}else{
		$(this).attr("value", "0");
	};
});


//autocomplete for colleges search 
  $("#college").autocomplete({
        source: function (request, response) {
                $.ajax({
                    url: "{{ URL::to('colleges/ajax') }}",
                    type: "GET",
                    cache: false,
                    dataType: "json",
                    success: function (data) {
                        var arr = [];
                        $(data).each(function( index ) {
                          arr.push({label:this.name, value:this.name});
                        });
                        console.log(arr);
                        response(arr);
                    },
                    data: {
                        term: request.term
                    }
                });
        }
      });


</script>

@stop

@section('content')


<h2 class="gradient-title">Edit your Settings</h2>

<form method="post" action="{{ URL::to('user/'.$user->id.'/edit') }}" class="form-horizontal">

  <fieldset>
  	<legend><h3 class="gradient-light"> ( * Required )</h3></legend>

	<!-- CSRF Token -->
	<input type="hidden" name="csrf_token" id="csrf_token" value="{{ Session::getToken() }}" />

	<!-- First Name -->
	<div class="control-group {{ $errors->has('firstname') ? 'error' : '' }}">
		<label class="control-label" for="firstname">First Name*</label>
		<div class="controls">
			<input type="text" name="firstname" id="firstname" value="{{ Request::old('firstname', $user->firstname) }}" />
			{{ $errors->first('firstname') }}
		</div>
	</div>
	<!-- ./ first name -->

	<!-- Last Name -->
	<div class="control-group {{ $errors->has('lastname') ? 'error' : '' }}">
		<label class="control-label" for="lastname">Last Name*</label>
		<div class="controls">
			<input type="text" name="lastname" id="lastname" value="{{ Request::old('lastname', $user->lastname) }}" />
			{{ $errors->first('lastname') }}
		</div>
	</div>
	<!-- ./ last name -->

	<!-- Email -->
	<div class="control-group {{ $errors->has('email') ? 'error' : '' }}">
		<label class="control-label" for="email">Email*</label>
		<div class="controls">
			<input type="text" name="email" id="email" value="{{ Request::old('email', $user->email) }}" />
			{{ $errors->first('email') }}
		</div>
	</div>
	<!-- ./ contacts -->

	<!-- Mobile Contacts -->
	<div class="control-group {{ $errors->has('contacts') ? 'error' : '' }}">
		<label class="control-label" for="contacts">Mobile Contacts*</label>
		<div class="controls">
			<input type="text" name="contacts" id="contacts" value="{{ Request::old('contacts', $user->contacts) }}" />
			{{ $errors->first('contacts') }}
		</div>
	</div>
	<!-- ./ contacts -->

	<!-- college Name -->
	<div class="control-group {{ $errors->has('college') ? 'error' : '' }}">
		<label class="control-label" for="college">College *</label>
		<div class="controls">
		<input type="text" name="college" id="college" value="{{ Request::old('college', $user->collegeName()) }}" style="float:left;"/>
		{{ $errors->first('college', '<span class="help-inline">:message</span>') }}
	    <span class="whyschool btn btn-primary ui-button-text">Why your school is important</span>
	    <br/><span class="cantfind">Can't find your school? <a href="mailto:info@bookcheetah.com">Email us</a> and we'll get it added in.</span>

		</div>
	</div>
	<!-- ./ college name -->

	<!-- Old Password -->
	<div class="control-group {{ $errors->has('oldpass') ? 'error' : '' }}">
		<label class="control-label" for="oldpass">Current Password*</label>
		<div class="controls">
			<input type="password" name="oldpass" id="oldpass" value="" />
			{{ $errors->first('oldpass') }}
		</div>
	</div>
	<!-- ./ oldpass -->

	<!-- Password -->
	<div class="control-group {{ $errors->has('password') ? 'error' : '' }}">
		<label class="control-label" for="password">New Password</label>
		<div class="controls">
			<input type="password" name="password" id="password" value="" />
			{{ $errors->first('password') }}
		</div>
	</div>
	<!-- ./ password -->

	<!-- Password Confirm -->
	<div class="control-group {{ $errors->has('password_confirmation') ? 'error' : '' }}">
		<label class="control-label" for="password_confirmation">Confirm New</label>
		<div class="controls">
			<input type="password" name="password_confirmation" id="password_confirmation" value="" />
			{{ $errors->first('password_confirmation') }}
		</div>
	</div>
	<!-- ./ password confirm -->

	<!-- Terms Name 
	<div class="control-group {{ $errors->has('terms') ? 'error' : '' }}">
		<label class="control-label" for="terms">I agree to the <a href="{{ URL::to('termsofuse') }}">Terms*</a></label>
		<div class="controls">
			<input type="checkbox" name="active" id="terms" value="0" checked/>
			{{ $errors->first('terms', '<span class="help-inline">:message</span>') }}
		</div>
		
	</div>
	 Terms name -->
	

	<!-- Update button -->
	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn">Update</button>
		</div>
	</div>
	<!-- ./ update button -->
	</fieldset>

 </form>

<div id="modal-content" style="display:none">
	<p>The goal of our service is to find your books locally, so that you can pick 
    them up in person without waiting for them to ship.  Then you can inspect 
    them in person before deciding to buy, and even arrange a swap, trade, loan, 
    rental instead of a sale if both parties are willing
  </p>
  <p>
    So if you'll tell us where you are, we can match you up with LOCAL people 
    who have the books that you want, or want the books that you have.  You'll 
    only be matched with areas that you indicate you are willing to consider.
  </p>
  <p>
    So save on shipping costs and time, while eliminating the risk of getting 
    something you don't really want.
  </p>

</div>
@stop

