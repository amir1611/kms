<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

	use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = RouteServiceProvider::HOME;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest')->except('logout');
	}

	public function login(Request $request)
	{
		$input = $request->all();

		$this->validate($request, [
			'ic' => ['required', 'digits:12'],
			'password' => 'required',
		]);

		if (auth()->attempt(array('ic' => $input['ic'], 'password' => $input['password']))) {
			if (auth()->user()->role == 'admin') {
				return redirect()->route('admin.home');
			} else if (auth()->user()->role == 'staff') {
				return redirect()->route('staff.home');
			} else if (auth()->user()->role == 'user') {
				return redirect()->route('user.home');
			}
		} else { 
			return redirect()
				->route('login')
				->with('error', 'Invalid ic number or password.');
		}
	}
}
