<?php

class UserController extends AuthorizedController
{
	/**
	 * Let's whitelist all the methods we want to allow guests to visit!
	 *
	 * @access   protected
	 * @var      array
	 */
	//@tim, these methods are protected from 'auth' filter:
	protected $whitelist = array(
		'getLogin',
		'postLogin',
		'getRegister',
		'postRegister'
	);

	/**
	 * Main users page.
	 *
	 * @access   public
	 * @return   View
	 */
	public function getIndex()
	{
		// Show the page.
		//
		//@tim, for admin to index users...
		return View::make('account/index')->with('user', Auth::user());
		//@tim, extending the AuthorisedController, with its filters is enough
		// if (Auth::check())
		// {
		// 	return Redirect::to('user/'.Auth::user()->id);

		// }
		// else
		// {
		// 	return Redirect::to('user/login');
		// }
	}
	//@tim , from UserController
	public function account($id)
    {
		// $courses = Course::all();

		if (User::find($id)):
			$user =  User::find($id);
			// $user = Auth::user();

	        if(!DB::table('courselists')->where('userid', $id)->first()){
		        return View::make('user/account')
		        	->with('user', $user)
					->with('info', "You have not added a course yet.");
	        };
	        $courses = DB::table('courselists')->where('userid', $id)->get();
	        // var_dump($courses);

			return View::make('user/account', compact('courses'))
				->with('user', $user);
		else:
			return View::make('template');
		endif;
    }

	/**
	 *
	 *
	 * @access   public
	 * @return   Redirect
	 */
	public function postIndex()
	{
		// Declare the rules for the form validation.
		//
		$rules = array(
			'first_name' => 'Required',
			'last_name'  => 'Required',
			'email'      => 'Required|Email|Unique:users,email,' . Auth::user()->email . ',email',
		);

		// If we are updating the password.
		//
		if (Input::get('password'))
		{
			// Update the validation rules.
			//
			$rules['password']              = 'Required|Confirmed';
			$rules['password_confirmation'] = 'Required';
		}

		// Get all the inputs.
		//
		$inputs = Input::all();

		// Validate the inputs.
		//
		$validator = Validator::make($inputs, $rules);

		// Check if the form validates with success.
		//
		if ($validator->passes())
		{
			// Create the user.
			//
			$user =  User::find(Auth::user()->id);
			$user->first_name = Input::get('first_name');
			$user->last_name  = Input::get('last_name');
			$user->email      = Input::get('email');

			if (Input::get('password') !== '')
			{
				$user->password = Hash::make(Input::get('password'));
			}

			$user->save();

			// Redirect to the register page.
			//
			return Redirect::to('account')->with('success', 'Account updated with success!');
		}

		// Something went wrong.
		//
		return Redirect::to('account')->withInput($inputs)->withErrors($validator->messages());
	}

	/**
	 * Login form page.
	 *
	 * @access   public
	 * @return   View
	 */
	public function getLogin()
	{
		// Are we logged in?
		//
		if (Auth::check())
		{
			return Redirect::to('account');
		}

		// Show the page.
		//
		return View::make('account/login');
	}

	/**
	 * Login form processing.
	 *
	 * @access   public
	 * @return   Redirect
	 */
	public function postLogin()
	{
		// Declare the rules for the form validation.
		//
		$rules = array(
			'email'    => 'required|email',
			'password' => 'required'
		);

		// Get all the inputs.
		//
		$email    = Input::get('email');
		$password = Input::get('password');

		// Validate the inputs.
		//
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success.
		//
		if ($validator->passes())
		{
			// Try to log the user in.
			//
			if (Auth::attempt(array('email' => $email, 'password' => $password)))
			{
				// Redirect to the users page.
				//
				return Redirect::to('account')->with('success', 'You have logged in successfully');
			}
			else
			{
				// Redirect to the login page.
				//
				return Redirect::to('account/login')->with('error', 'Email/password invalid.');
			}
		}

		// Something went wrong.
		//
		return Redirect::to('account/login')->withErrors($validator);
	}

	/**
	 * User account creation form page.
	 *
	 * @access   public
	 * @return   View
	 */
	public function getRegister()
	{
		// Are we logged in?
		//
		if (Auth::check())
		{
			return Redirect::to('account');
		}

		// Show the page.
		//
		return View::make('account/register');
	}

	/**
	 * User account creation form processing.
	 *
	 * @access   public
	 * @return   Redirect
	 */
	public function postRegister()
	{
		// Declare the rules for the form validation.
		//
		$rules = array(
			'first_name'            => 'required',
			'last_name'             => 'required',
			'email'                 => 'required|email|unique:users',
			'password'              => 'required|confirmed',
			'password_confirmation' => 'required'
		);

		// Validate the inputs.
		//
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success.
		//
		if ($validator->passes())
		{
			// Create the user.
			//
			$user = new User;
			$user->first_name = Input::get('first_name');
			$user->last_name  = Input::get('last_name');
			$user->email      = Input::get('email');
			$user->password   = Hash::make(Input::get('password'));
			$user->save();

			// Redirect to the register page.
			//
			return Redirect::to('account/register')->with('success', 'Account created with success!');
		}

		// Something went wrong.
		//
		return Redirect::to('account/register')->withInput()->withErrors($validator);
	}

	/**
	 * Logout page.
	 *
	 * @access   public
	 * @return   Redirect
	 */
	public function getLogout()
	{
		// Log the user out.
		//
		Auth::logout();

		// Redirect to the users page.
		//
		return Redirect::to('account/login')->with('success', 'Logged out with success!');
	}

	//@tim from UserController
	public function getEdit($id)
	{
		// Show the page.
		//
		
		if(Auth::user()->id == $id ){
			//$user =  User::find($id);
			$user =  User::find(Auth::user()->id);
			// var_dump($user);
			return View::make('user/edit')->with('user', $user);
		}
		else{
			$id = Auth::user()->id;
			$user =  User::find($id);

			return Redirect::to('user/'.$id.'/edit')->with('user', $user);
		};
	}


	/**
	 *
	 *
	 * @access   public
	 * @return   Redirect
	 */
	public function postEdit()
	{
		// Declare the rules for the form validation.
		//
		$rules = array(
			'firstname' =>	'Required',
			'lastname'  =>	'Required',
			'email'     =>	'Required|Email|Unique:users,email,' . Auth::user()->email . ',email',
			'contacts'  =>	'Required',
			'oldpass'	=>	'Required|passcheck',
			'password'	=>	'Confirmed', //by password_confirmation'
			'college'	=>	'Required|exists:colleges,name',
			//'terms'		=>	'Required|accepted', //not working!
		);

		// if(!DB::table('colleges')->where('name', Input::get('college'))->first()){
		// 	//return college validation error
		// }

		$messages = array(
			'passcheck' => 'Your old password was incorrect',
			//'accepted' => 'You have to accept the terms of service!',
		    //'exists' => 'Please type and pick a college from the dropdown',
		);

		// Validator::extend('accepted', function($attribute, $value, $parameters)
		// {
		// 	if(Input::get('terms') == 0){
		// 		return false;
		// 	}
		// 	else{
		// 		return true;
		// 	};
		// });

		Validator::extend('passcheck', function($attribute, $value, $parameters)
		{
			// if(DB::table('users')->where('password', Hash::make(Input::get('oldpass')))->first()){
			// 	return true;
			// }
			// else{
			// 	return false;
			// };

			$user =  User::find(Auth::user()->id);
			if (Hash::check(Input::get('oldpass'), $user->password)) {
			    // The passwords match...
			    return true;
			}
			else {
			    return false;
			}
		});


		// Get all the inputs.
		//
		$inputs = Input::all();

		
		// Validate the inputs.
		//
		$validator = Validator::make($inputs, $rules, $messages);


		// Check if the form validates with success.
		//



		
		//if (Auth::attempt(array('email' => $email, 'password' => $password)))


		if ($validator->passes())
		{
			// Edit the user.
			//
			$user =  User::find(Auth::user()->id);
			$id =  $user->id;
			$user->firstname = Input::get('firstname');
			$user->lastname  = Input::get('lastname');
			$user->email     = Input::get('email');
			$user->contacts  = Input::get('contacts');

			$collegearray = DB::table('colleges')->where('name', 'like', Input::get('college'))->get();
			//var_dump($college);
			$user->collegeid   = $collegearray['0']->id;

			if (Input::get('password') !== '')
			{
				$user->password = Hash::make(Input::get('password'));
			}

			$user->save();


			return Redirect::to('user/'.$id)->with('success', 'Account updated with success!');

		}

		// Something went wrong.
		//
		$user =  User::find(Auth::user()->id);
		$id =  $user->id;
		return Redirect::to('user/'.$id.'/edit')
						->withInput($inputs)
						->withErrors($validator->messages());

	}
}
