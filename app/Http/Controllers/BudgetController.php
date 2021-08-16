<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Categories;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budgets = Budget::where('user_id', auth()->user()->id)->get();
        $categories = Categories::whereNotIn('name', ['Income'])->get();
        //dd($months);
        return view('budget', ['budgets' => $budgets, 'categories' => $categories, ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $budget = Budget::create($request->all());
        $budget->save();
        return back()->with('success', 'Budget Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        Budget::find($id)->delete();
        return back()->with('success', 'Budget Deleted Successfully');
    }


    public function viewBudget()
    {
        return view('view_budget');
    }

    public function markDone($id)
    {
        $budget = Budget::find($id);
        if($budget){
            $category = Categories::where('name', $budget->type)->first();
            $budget->update(['status' => true]);
            Transaction::create(['user_id' => auth()->user()->id, 'transaction_date' => Carbon::now(), 'name' => $budget->name, 'amount' => $budget->amount,
                'category_id' => $category->id, 'category' => $budget->type, 'type' => 'Debit', 'description' => $budget->description, 'from_budget' => true ]);
            return back()->with('success', 'Budget Completed Successfully');
        }else{
            return back()->with('error', 'Budget could not be completed');
        }
    }

    public function remove($id)
    {
       $budget = Budget::where('id', $id)->first();//find($id)->delete();
        $budget->delete();
        return back()->with('success', 'Budget Deleted Successfully');
    }


}
