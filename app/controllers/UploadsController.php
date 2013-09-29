<?php

class UploadsController extends BaseController {

	/**
	 * Upload Repository
	 *
	 * @var Upload
	 */
	protected $upload;

	public function __construct(Upload $upload)
	{
		$this->upload = $upload;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$uploads = $this->upload->all();

		return View::make('uploads.index', compact('uploads'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('uploads.create');
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
		$files = Input::file('files'); // your file upload input field in the form should be named 'file'
		// return var_dump($files);

		foreach ($files as $file) {
			$destinationPath = 'uploads/'.str_random(8);
			// return var_dump($file);
			$filename = $file->getClientOriginalName();
			//$extension =$file->getClientOriginalExtension(); //if you need extension of the file
			// $filename = $file['originalName'];
			// return var_dump($filename);
			
			$upload['url'] = $destinationPath.$filename;
			$upload['title'] = $filename;
			$upload['order_id'] = $input['order_id'];
			$upload['user_id'] = Auth::user() ? Auth::user()->id : '';
			$upload['downloads'] = '';
			$upload['category'] = $input['category'];

			$this->upload->create($upload);

			$uploadSuccess = $file->move($destinationPath, $filename);

			if( $uploadSuccess ) {
			   Response::json('success', 200); // or do a redirect with some message that file was uploaded
			} else {
			   Response::json('error', 400);
			}
		}
		
		return Response::json('success', 200);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$upload = $this->upload->findOrFail($id);

		return View::make('uploads.show', compact('upload'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$upload = $this->upload->find($id);

		if (is_null($upload))
		{
			return Redirect::route('uploads.index');
		}

		return View::make('uploads.edit', compact('upload'));
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
		$validation = Validator::make($input, Upload::$rules);

		if ($validation->passes())
		{
			$upload = $this->upload->find($id);
			$upload->update($input);

			return Redirect::route('uploads.show', $id);
		}

		return Redirect::route('uploads.edit', $id)
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
		$this->upload->find($id)->delete();

		return Redirect::route('uploads.index');
	}

}
