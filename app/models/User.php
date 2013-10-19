<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Get the user full name.
	 *
	 * @access   public
	 * @return   string
	 */
	public function firstName()
	{
		return $this->firstname;
	}
	public function lastName()
	{
		return $this->lastname;
	}
	public function fullName()
	{
		return $this->firstname . ' ' . $this->lastname;
	}
	public function fullNameLink()
	{
		return '<a href="'.URL::to('user/'.$this->id).'">'.$this->fullName().'</a>';
	}
	public function wishlistLink()
	{
		return '<a href="'.URL::to('wishlist/user/'.$this->id).'">Wishlist</a>';
	}
	public function bookshelfLink()
	{
		return '<a href="'.URL::to('bookshelf/user/'.$this->id).'">Bookshelf</a>';
	}
	public function booksLink()
	{
		if(Auth::user()->id == $this->id){
			return '<a href="'.URL::to('books/user/' . $this->id) . '">My Books</a>';
		}
		else{
			return '<a href="'.URL::to('books/user/' . $this->id) . '">' . $this->firstname . '\'s Books</a>';
		};
	}
	public function collegeId(){
		return $this->collegeid;
	}

	public function collegeName()
	{

		if(DB::table('colleges')->where('id', $this->collegeid)->first()){
			$collegeobject = DB::table('colleges')->where('id', $this->collegeid)->first();
			$collegename = $collegeobject->name; //Auth::user()->collegeName()
			return $collegename;
		}
		
		else{
			return '';
		}
	}

	public function collegeURL()
	{

		if(DB::table('colleges')->where('id', $this->collegeid)->first()){
			$collegeobject = DB::table('colleges')->where('id', $this->collegeid)->first();
			$collegeid = $collegeobject->id; //Auth::user()->collegeName()
			return URL::to('colleges/'.$collegeid);
		}
		else{
			return URL::to('user/'.$this->id.'/edit');
		}
		//User::find(Auth::user()->id);
		// Retrieving A Single Row From A Table:
		// $user = DB::table('user')->where('name', 'John')->first();
	}
	public function collegeLink(){

		if(DB::table('colleges')->where('id', $this->collegeid)->first()):
            return '<a href="'.$this->collegeURL().'">'.$this->collegeName().'</a>';
        else:
            return 'Not Specified';
        endif;
	}
	public function myCollegeLink(){

		if(DB::table('colleges')->where('id', $this->collegeid)->first()):
            return '<a href="'.Auth::user()->collegeURL().'">'.Auth::user()->collegeName().'</a>';
        else:
        	$id = $this->id;
            $editlink = URL::to('user/'.$id.'/edit');
            $addcollege = '<a href="'.$editlink.'">Add College</a>';
            return $addcollege;
        endif;
	}


	public function email()
	{
		return $this->email;
	}
	public function mailto()
	{
		return '<a href="mailto:'.$this->email.'">'.$this->email.'</a>';
	}

	public function contacts(){
		return $this->contacts;
	}

	public function id(){
		return $this->id;
	}
	public static function adminCheck()
	{
		if(Auth::user()):
			$id = Auth::user()->id;
			$admin = array(1,2,4); //1 || 2 || 3;

			if (in_array(Auth::user()->id, $admin) == TRUE):
				return true;
			endif;
		else:
			return false;
		endif;
		
	}
	public static function editButton($ownerid, $context, $itemid)
	{
		if(!Auth::user()){
			echo "";
		}
		elseif(Auth::user()->id != $ownerid){
			echo "";
		}
		else{
			return link_to_route($context.'.edit', 'Edit', array($itemid), array('class' => 'btn btn-info'));
			//link_to_route('bookshelf.edit', 'Edit', array($bookshelf->id), array('class' => 'btn btn-info'));
		}
		
	}
	public static function deleteButton($ownerid, $context, $itemid)
	{
		if(!Auth::user()){
			echo "";
		}
		elseif(Auth::user()->id != $ownerid){
			echo "";
		}
		else{
			echo Form::open(array('method' => 'DELETE', 'route' => array($context.'.destroy', $itemid)));
			echo Form::submit('Delete', array('class' => 'btn btn-danger'));
			echo Form::close();
			//link_to_route('bookshelf.edit', 'Edit', array($bookshelf->id), array('class' => 'btn btn-info'));
			// {{ Form::open(array('method' => 'DELETE', 'route' => array('wishlist.destroy', $wishlist->id))) }}
            //	{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
            //{{ Form::close() }}
		}
		
	}
	public static function addBook($ownerid, $context)
	{
		if(!Auth::user()){
			echo "";
		}
		elseif(Auth::user()->id != $ownerid){
			echo "";
		}
		else{
			return link_to_route($context.'.create', 'Add a book to your '.$context, null, array('class' => 'btn btn-primary addbook'));
			// link_to_route('wishlist.create', 'Add a Book to your Wishlist');
		}
		
	}


}