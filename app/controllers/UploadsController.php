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
		$validation = Validator::make($input, Upload::$rules);

		if ($validation->passes())
		{
			$this->upload->create($input);

			return Redirect::route('uploads.index');
		}

		return Redirect::route('uploads.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
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
