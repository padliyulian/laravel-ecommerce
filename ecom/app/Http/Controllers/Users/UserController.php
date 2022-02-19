<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = \Auth::user();
		
		$this->data['provinces'] = $this->getProvinces();
		$this->data['cities'] = isset(\Auth::user()->province_id) ? $this->getCities(\Auth::user()->province_id) : [];
		$this->data['user'] = $user;

		return $this->load_theme('auth.profile', $this->data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request request params
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$params = $request->except('_token');

		$user = \Auth::user();

		if ($user->update($params)) {
			\Session::flash('success', 'Your profile have been updated!');
			return redirect('user');
		}
	}
}
