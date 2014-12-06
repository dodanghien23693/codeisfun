<?php

class UserController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
public function search()
{
    $name = Input::get('character');
    $searchResult = User::where('email', 'like', "%".$name."%")->paginate(10);
    return View::make('admin.users.index')
            ->with('email', $name)
            ->with('users', $searchResult);
}
	public function index()
	{
		$users = User::all();

		return View::make('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		User::$rules = array();
		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{
			try{
			User::create(Input::all());
			//$b=User::save();
			
			}
			catch(\Exception $e)
			{
			//dd('error');
			//dd($e);
			}

			return Redirect::route('admin.user.index');
		}

		return Redirect::route('admin.user.create')
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
		$user = User::findOrFail($id);

		return View::make('admin.users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);

		if (is_null($user))
		{
			return Redirect::route('admin.user.index');
		}

		return View::make('admin.users.edit', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$phet=User::find($id);
		$input = array_except(Input::all(), '_method');
		if($input['password']=='')
			$input['password']=$phet->password;
		User::$rules['username'].=",".$phet->id;
		User::$rules['email'].=",".$phet->id;
		$validation = Validator::make($input, User::$rules);

		if ($validation->passes())
		{

			$user = User::find($id);
			$user->update($input);

			return Redirect::route('admin.user.show', $id);
		}

		return Redirect::route('admin.user.edit', $id)
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
		User::find($id)->delete();

		return Redirect::route('admin.user.index');
	}

}
