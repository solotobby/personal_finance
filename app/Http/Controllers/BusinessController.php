<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Staffs;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Categories;
use App\Models\Loan;
use App\Models\Transaction;
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
        $business->user_id = Auth::id();
        $business->business_name = $validated['business_name'];
        $business->business_email = $validated['business_email'];
        $business->business_number = $validated['business_phone'];
        $business->business_description = $validated['business_description'];
        $business->save();

        $user = Auth::user();
        $user->has_business_account = true;
        $user->business_id = $business->id;
        $user->save();

        // Update related records to link them to the new business
        $businessId = $business->id;
        $userId = $user->id;

        Transaction::where('user_id', $userId)->update(['business_id' => $businessId]);
       // Staffs::where('user_id', $userId)->update(['business_id' => $businessId]);
       // Categories::where('user_id', $userId)->update(['business_id' => $businessId]);
        Loan::where('user_id', $userId)->update(['business_id' => $businessId]);
        Budget::where('user_id', $userId)->update(['business_id' => $businessId]);

        // Redirect or return a success message
        return redirect()->route('dashboard')->with('success', 'Business account created successfully!');
    }
}
