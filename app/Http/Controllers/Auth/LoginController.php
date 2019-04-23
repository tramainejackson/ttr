<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function index()
	{
		return view('auth.login');
	}

	/**
	 * Handle an authentication attempt.
	 *
	 * @return Response
	 */
	public function authenticate(Request $request)
	{

		if(Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
			// Once authenticated, make sure this is a
			// league account with totherec
			$user = Auth::user();

			if($user->type == 'commish') {

				// This needs to redirect the commish to the regular totherec site
				return redirect()->action('LeagueProfileController@edit', ['league' => $user->league->id]);

			} elseif($user->type == 'writer') {

				// This needs to redirect the writer to the regular totherec site
				return redirect()->action('WriterProfileController@edit', ['writer' => $user->writer->id]);

			} elseif($user->type == 'player') {

				// This needs to redirect the player to the regular totherec site
				return redirect()->action('PlayerProfileController@edit', ['player' => $user->player->id]);

			} else {

				// Add Admin cookie to the session
				session(['admin' => true]);

				// This needs to redirect the player to the regular totherec site
				return redirect()->action('HomeController@index');

			}

		} else {
			return redirect()->back()->with(['error' => 'The username/password combination you entered is incorrect.']);
		}
	}
}
