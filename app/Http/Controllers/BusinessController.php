<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    public function create(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_email' => 'required|email|unique:businesses,business_email',
            'business_phone' => 'required|string|max:15',
            'business_description' => 'required|string|max:255',
        ]);

        // Save the business information
        $business = new Business();
        $business->user_id = Auth::id(); // Assuming user is logged in
        $business->business_name = $validated['business_name'];
        $business->business_email = $validated['business_email'];
        $business->business_number = $validated['business_phone'];
        $business->business_description = $validated['business_description'];
        $business->save();

        // Update the user to indicate they now have a business account
        $user = Auth::user();
        $user->has_business_account = true;
        $user->save();

        // Redirect or return a success message
        return redirect()->route('dashboard')->with('success', 'Business account created successfully!');
    }
}
