<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Business;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //rotected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function validators($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'business_email' => 'required|string|email|max:255|unique:business,business_email',
            'business_name' => 'required|string|max:255',
            'business_description' => 'required|string|max:255',
            'business_phone' => 'required|string|max:255',
        ]);
    }

    public function createUser(Request $validated)
    {

        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users,email',
        //     'password' => 'required|string|min:8|confirmed',
        //     'business_email' => 'required|string|email|max:255|unique:businesses,business_email',
        //     'business_name' => 'required|string|max:255',
        //     'business_description' => 'required|string|max:255',
        //     'business_phone' => 'required|string|max:255',
        // ]);
        // Start a database transaction to ensure both user and business are created
        DB::beginTransaction();

        try {
            // Create the user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Create the business and associate it with the user
            $business = Business::create([
                'user_id' => $user->id,  // Foreign key to associate the business with the user
                'business_name' => $validated['business_name'],
                'business_description' => $validated['business_description'],
                'business_number' => $validated['business_phone'],
                'business_email' => $validated['business_email'],
            ]);

            // Commit the transaction
            DB::commit();

          //  return $validated;

            if ($user && $business) {
                Auth::login($user);
                return redirect('/dashboard');
            }
         } catch (\Exception $e) {
                DB::rollBack();
                return redirect('/register')
                    ->withInput()
                    ->withErrors(['error' => 'Failed to create user and business account.']);
            }

    }
}
