<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\Business;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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


    public function showCreateBusinessAccountPage()
    {
        return view('auth.create_business_account');
    }

    // public function loginUser(Request $request)
    // {
    //     // Validate login credentials
    //     $request->validate([
    //         'email' => ['required', 'string', 'max:255'], // Accepts email or staff_id
    //         'password' => ['required', 'string'],
    //     ]);

    //     $credentials = [
    //         filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'staff_id' => $request->email,
    //         'password' => $request->password,
    //     ];

    //     // Attempt to log the user in
    //     if (Auth::attempt($credentials, $request->remember)) {
    //         $user = Auth::user();

    //         if ($user instanceof \App\Models\Staffs) {
    //             return redirect()->route('staff.dashboard');
    //         }

    //         return redirect()->route('dashboard');
    //     }

    //     // If authentication fails, return with an error
    //     return redirect()->back()->with('error', 'The provided credentials are incorrect.');
    // }

    public function loginUser(Request $request)
{
    $credentials = $request->validate([
        'login_identifier' => 'required|string',
        'password' => 'required|string',
    ]);

    // Determine the authentication field and guard
    if (filter_var($credentials['login_identifier'], FILTER_VALIDATE_EMAIL)) {
        $fieldType = 'email';
        $guard = 'web'; // Authenticate via users table
    } else {
        $fieldType = 'staff_id';
        $guard = 'staffs'; // Authenticate via staffs table
    }

    // Attempt authentication
    if (Auth::guard($guard)->attempt(
        [$fieldType => $credentials['login_identifier'], 'password' => $credentials['password']],
        $request->filled('remember')
    )) {
        // Redirect based on authentication type
        return $guard === 'staffs'
            ? redirect()->route('staff.dashboard')
            : redirect()->route('dashboard');
    }

    // If authentication fails, throw an error
    throw ValidationException::withMessages([
        'login_identifier' => [trans('auth.failed')],
    ]);
}




    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
