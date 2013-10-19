<?php

class XfilesController extends BaseController {

	/**
	 * Xfile Repository
	 *
	 * @var Xfile
	 */
	protected $xfile;

	public function __construct(Xfile $xfile)
	{
		$this->xfile = $xfile;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$xfiles = $this->xfile->all();

		return View::make('xfiles.index', compact('xfiles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('xfiles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		// return var_dump($input);
		$xfiles = Input::file('files'); // your file upload input field in the form should be named 'file'
		// return var_dump($xfiles);
		$success = 'Successful: ';
		$time = time();
		foreach ($xfiles as $xfile) {
			$uploadFolder = 'public/uploads/'.$time;
			// return var_dump($xfile);
			$filename = $xfile->getClientOriginalName();
			//$extension =$xfile->getClientOriginalExtension(); //if you need extension of the file
			// $filename = $xfile['originalName'];
			// return var_dump($filename);
			
			$upload['url'] = 'uploads/'.$time.'/'.$filename;
			$upload['title'] = $filename;
			$upload['order_id'] = $input['order_id'];
			$upload['user_id'] = Auth::user() ? Auth::user()->id : '';
			$upload['downloads'] = '';
			$upload['category'] = $input['category'];

			$this->xfile->create($upload);

			$uploadSuccess = $xfile->move($uploadFolder, $filename);

			if( $uploadSuccess ) {
			   $success .= $filename. ','; // or do a redirect with some message that file was uploaded
			}
		}
		return Response::json($success);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$xfile = $this->xfile->findOrFail($id);

		return View::make('xfiles.show', compact('xfile'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$xfile = $this->xfile->find($id);

		if (is_null($xfile))
		{
			return Redirect::route('xfiles.index');
		}

		return View::make('xfiles.edit', compact('xfile'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Xfile::$rules);

		if ($validation->passes())
		{
			$xfile = $this->xfile->find($id);
			$xfile->update($input);

			return Redirect::route('xfiles.show', $id);
		}

		return Redirect::route('xfiles.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->xfile->find($id)->delete();

		return Redirect::route('xfiles.index');
	}

}
