<?php


namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Category;
use App\Models\Role;
use App\Models\Department;
use App\Models\Qualification;
use App\Models\Type;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        //$business = $user->businesses->first();

        $data['categories'] = Categories::where(function ($query) use ($user) {
            $query->where('business_id', $user->business_id)
                  ->orWhereNull('business_id');
        })->get();
        $data['roles'] = Role::where(
            'business_id',
            $user->business_id
        )->get();
        $data['departments'] = Department::where(
            'business_id',
            $user->business_id
        )->get();
        $data['qualifications'] = Qualification::where(
            'business_id',
            $user->business_id
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
       // $business = $user->businesses->first();

        $cat = new Categories;
        $cat->name = $request->name;
        $cat->description = $request->description;
        $cat->business_id = $user->business_id;
        $cat->is_credit = $request->has('is_credit') ? true : false;
        $cat->save();

        return back()->with('success', 'Category added successfully');
    }

    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $user = auth()->user();
       // $business = $user->businesses->first();

        $role = new Role;
        $role->name = $request->name;
        $role->business_id = $user->business_id;
        $role->save();
        return back()->with('success', 'Role added successfully');
    }

    public function storeType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $type = new Type([
            'name' => $request->name,
            'description' => $request->description ? $request->description : 'null',
            'category_id' => $request->category_id,
        ]);
        $type->save();

        return back()->with('success', 'Type added successfully');
    }


    public function storeDepartment(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $user = auth()->user();
       // $business = $user->businesses->first();

        $dept = new Department;
        $dept->name = $request->name;
        $dept->business_id = $user->business_id;
        $dept->save();
        return back()->with('success', 'Department added successfully');
    }

    public function storeQualification(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $user = auth()->user();
        //$business = $user->businesses->first();

        $qual = new Qualification();
        $qual->name = $request->name;
        $qual->business_id = $user->business_id;
        $qual->save();

        return back()->with('success', 'Qualification added successfully');
    }
}
