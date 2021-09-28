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
        $categories = Categories::pluck('name', 'id')->toArray();
        return view('budget/create', ['budgets' => $budgets, 'categories' => $categories]);
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
        $data = $request->validate([
            'date' => 'required|date_format:Y-m',
            'name' => 'required|string',
            'amount' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);
        $data['date'] = \Carbon\Carbon::parse($request->date)->toDateTimeString();
        Budget::create($data + ['user_id' => auth()->user()->id]);
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
        Budget::find($id)->delete();
        return back()->with('success', 'Budget Deleted Successfully');
    }


    public function viewBudget()
    {
        $budgets = Budget::where('user_id', auth()->user()->id)->get();
        return view('budget.view_budget', ['budgets' => $budgets]);
    }

    public function markDone($id)
    {
        $budget = Budget::findOrFail($id);
        Transaction::create(['user_id' => auth()->user()->id, 'date' => Carbon::now(), 'type_id' => "13", 'name' => $budget->name, 'amount' => $budget->amount, 'category_id' => $budget->category_id, 'description' => $budget->description, 'budget_id' => $id ]);
        $budget->update(['status' => true]);
        return back()->with('success', 'Budget Completed Successfully');
    }

    public function remove($id)
    {
       $budget = Budget::where('id', $id)->first();//find($id)->delete();
        $budget->delete();
        return back()->with('success', 'Budget Deleted Successfully');
    }


}
