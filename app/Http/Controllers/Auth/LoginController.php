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

    public function loginUser(Request $request)
    {
        // Validate login credentials
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        // Attempt to log the user in
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember));

        if (Auth::user()) { 

            return route('/dashboard'); // Redirect to dashboard
        }

        // If authentication fails, return with an error
        return redirect('/register')
            ->withInput()
            ->withErrors(['error' => 'The provided credentials are incorrect.']);
    }


    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function createBusinessAccount(Request $request)
    {
        // return true;
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_email' => 'required|email|max:255',
            'business_phone' => 'required|string|max:20',
            'business_description' => 'required|string|max:500',
        ]);

        try {
            //error_log('This is a console log message from Laravel');


            $user = Auth::user();
            // Create a new business account (example)
            $business = Business::create([
                'name' => $validatedData['business_name'],
                'email' => $validatedData['business_email'],
                'phone' => $validatedData['business_phone'],
                'description' => $validatedData['business_description'],
                'user_id' => $user->id(), // Associate with the authenticated user
            ]);

            // $user->has_business_account = true;
            // $user->save();


            return response()->json(['success' => true, 'message' => 'Business account created successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create business account.'], 500);
        }
    }
}
