<?php

class OrdersController extends BaseController {

	/**
	 * Order Repository
	 *
	 * @var Order
	 */
	protected $order;

	public function __construct(Order $order)
	{
		$this->order = $order;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$orders = $this->order->all();

		return View::make('orders.index', compact('orders'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('orders.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Order::$rules);

		if ($validation->passes())
		{
			$this->order->create($input);

			return Redirect::route('orders.index');
		}

		return Redirect::route('orders.create')
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
		$order = $this->order->findOrFail($id);

		return View::make('orders.show', compact('order'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$order = $this->order->find($id);

		if (is_null($order))
		{
			return Redirect::route('orders.index');
		}

		return View::make('orders.edit', compact('order'));
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
		$validation = Validator::make($input, Order::$rules);

		if ($validation->passes())
		{
			$order = $this->order->find($id);
			$order->update($input);

			return Redirect::route('orders.show', $id);
		}

		return Redirect::route('orders.edit', $id)
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
		$this->order->find($id)->delete();

		return Redirect::route('orders.index');
	}

}
