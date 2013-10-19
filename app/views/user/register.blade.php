@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Register
@stop


@section('css')

 <link rel="stylesheet" href="{{ asset('assets/styles/css/register-edit.css')}} ">

@stop

@section('js')

<!-- Load SimpleModal and Basic JS files -->
<script src="{{ asset('assets/scripts/js/plugins.js') }}"></script>
<script src="{{ asset('assets/scripts/js/jquery.simplemodal.js') }}"></script>
<script src="{{ asset('assets/scripts/js/basic.js') }}"></script>
 

<script type="text/javascript">

$('form .control-group span.whyschool').on('click', function(){

		$('.modal-body').slideToggle(1000);
		// $('#myModal').modal('show');

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

<h2 class="gradient-title">Join the BookCheetah Marketplace</h2>

<form method="post" action="" class="form-horizontal">

  <fieldset>
  	<legend><h3 class="gradient-light">Register Now ( * Required )</h3></legend>

	<!-- CSRF Token -->
	<input type="hidden" name="csrf_token" id="csrf_token" value="{{ Session::getToken() }}" />

	<!-- First Name -->
	<div class="control-group {{ $errors->has('firstname') ? 'error' : '' }}">
		<label class="control-label" for="firstname">First Name*</label>
		<div class="controls">
			<input type="text" name="firstname" id="firstname" value="{{ Request::old('firstname') }}" />
			{{ $errors->first('firstname', '<span class="help-inline">:message</span>') }}
		</div>
	</div>
	<!-- ./ first name -->

	<!-- Last Name -->
	<div class="control-group {{ $errors->has('lastname') ? 'error' : '' }}">
		<label class="control-label" for="lastname">Last Name*</label>
		<div class="controls">
			<input type="text" name="lastname" id="lastname" value="{{ Request::old('lastname') }}" />
			{{ $errors->first('lastname', '<span class="help-inline">:message</span>') }}
		</div>
	</div>
	<!-- ./ last name -->

	<!-- Email -->
	<div class="control-group {{ $errors->has('email') ? 'error' : '' }}">
		<label class="control-label" for="email">Email*</label>
		<div class="controls">
			<input type="text" name="email" id="email" value="{{ Request::old('email') }}" />
			{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
		</div>
	</div>
	<!-- ./ email -->

	<!-- contacts -->
	<div class="control-group {{ $errors->has('contacts') ? 'error' : '' }}">
		<label class="control-label" for="contacts">Mobile Contacts*</label>
		<div class="controls">
			<input type="text" name="contacts" id="contacts" value="{{ Request::old('contacts') }}" />
			{{ $errors->first('contacts', '<span class="help-inline">:message</span>') }}
		</div>
	</div>
	<!-- ./ contacts -->

	<!-- college Name -->
	<div class="control-group {{ $errors->has('college') ? 'error' : '' }}">
		<label class="control-label" for="college">College *</label>
		<div class="controls">
			<input type="text" name="college" id="college" value="{{ Request::old('college') }}" style="float:left;"/>
			{{ $errors->first('college', '<span class="help-inline">:message</span>') }}
			
		     <span class="whyschool btn btn-primary ui-button-text">
		     	<!--  data-toggle="modal" href="#myModal"  -->
		     	Why your school is important
		     </span>
		     <br/><span class="cantfind">Can't find your school? <a href="mailto:info@bookcheetah.com">Email us</a> and we'll get it added in.</span>


		</div>
	</div>
	<!-- ./ college name -->


	<!-- Password -->
	<div class="control-group {{ $errors->has('password') ? 'error' : '' }}">
		<label class="control-label" for="password">Password</label>
		<div class="controls">
			<input type="password" name="password" id="password" value="" />
			{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
		</div>
	</div>
	<!-- ./ password -->

	<!-- Password Confirm -->
	<div class="control-group {{ $errors->has('password_confirmation') ? 'error' : '' }}">
		<label class="control-label" for="password_confirmation">Confirm New</label>
		<div class="controls">
			<input type="password" name="password_confirmation" id="password_confirmation" value="" />
			{{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}
		</div>
	</div>
	<!-- ./ password confirm -->

	<!-- Terms Name -->
	<div class="control-group {{ $errors->has('terms') ? 'error' : '' }}">
		<label class="control-label" for="terms">I agree to the <a href="{{ URL::to('termsofuse') }}">Terms*</a></label>
		<div class="controls">
			<input type="checkbox" name="active" id="terms" value="0" checked />
			{{ $errors->first('terms', '<span class="help-inline">:message</span>') }}
		</div>
		
	</div>
	<!-- ./ Terms name -->
	

		<!-- Signup button -->
	<div class="control-group">
		<div class="controls">
			<button class="btn btn-primary submituser" type="submit" class="btn">Signup</button>
			<!-- <input class="btn btn-primary submitbook" type="submit" value="Edit Profile" style="font-size: 15px;"> -->
		</div>
	</div>
	<!-- ./ signup button -->

	<div class="modal-body" style="display:none">
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

	<!-- Why school Modal -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
		  <div class="modal-content">
		    <div class="modal-header">
		      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		      <h4 class="modal-title">Why You School Is Important</h4>			 
		    </div>

		    <div class="modal-footer">
		      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
		  </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	</fieldset>

 </form>


@stop

