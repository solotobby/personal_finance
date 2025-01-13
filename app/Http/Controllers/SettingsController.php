<?php


namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Category;
use App\Models\Role;
use App\Models\Department;
use App\Models\Type;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $business = $user->businesses->first();

        $data['categories'] = Categories::where(
            'business_id',
            $business->id
        )->get();
        $data['roles'] = Role::where(
            'business_id',
            $business->id
        )->get();
        $data['departments'] = Department::where(
            'business_id',
            $business->id
        )->get();
        $data['types'] = Type::whereIn(
            'category_id',
            $data['categories']->pluck('id')
        )->get();


        //return response()->json($data);
        return view('setting', $data);
    }

    public function storeCategory(Request $request)
    {
        $user = auth()->user();
        $business = $user->businesses->first();

        $cat = new Categories;
        $cat->name = $request->name;
        $cat->description = $request->description;
        $cat->business_id = $business->id;
        $cat->is_credit = $request->has('is_credit') ? true : false;
        $cat->save();

        return back()->with('success', 'Category added successfully');
    }

    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $user = auth()->user();
        $business = $user->businesses->first();

        $role = new Role;
        $role->name = $request->name;
        $role->business_id = $business->id;
        $role->save();
        return back()->with('success', 'Role added successfully');
    }

    public function storeType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id', // Validate that category exists
        ]);

        // Create the Type
        $user = auth()->user();
        $business = $user->businesses->first();

        $type = new Type([
            'name' => $request->name,
            'description' => $request->description ? $request->description : 'null',
            'category_id' => $request->category_id, // Assign the selected category
        ]);
        $type->save();

        return back()->with('success', 'Type added successfully');
    }


    public function storeDepartment(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $user = auth()->user();
        $business = $user->businesses->first();

        $dept = new Department;
        $dept->name = $request->name;
        $dept->business_id = $business->id;
        $dept->save();
        return back()->with('success', 'Department added successfully');
    }
}
