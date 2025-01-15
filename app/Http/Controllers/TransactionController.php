<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Budget;
use App\Models\Categories;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function summary()
    {
        $data['income'] = Transaction::AllTransaction(config('app.categories.income.id'))->sum('amount');
        $data['savings'] = Transaction::AllTransaction(config('app.categories.savings.id'))->sum('amount');
        $data['expenses'] = Transaction::AllTransaction(config('app.categories.expenses.id'))->sum('amount');
        $data['transactions'] = Transaction::myLatest(5)->get();
        $data['categories'] = Categories::pluck('name', 'id')->toArray();
        $data['budgets'] = Budget::where('user_id', auth()->user()->id)->get();
        $data['types'] = Type::pluck('name', 'id')->toArray();
        return view('transactions.summary', $data);
    }

    public function report(Request $request)
    {
        $request->validate([
            'month' => 'nullable|string',
            // 'to' => 'nullable|date',
            // 'from' => 'nullable|date',
        ]);

        $currentMonthYear = Carbon::now()->format('m-Y');
        $months = '';
        $months = $request->month == '' ? $currentMonthYear : $request->month;
        $monthList = explode('-', $months);

        $month = $monthList[0];  // July
        $year = $monthList[1];

        $data['date'] = $months;
        $data['transactions'] = Transaction::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->orderBy('date', 'DESC')
            ->get();

        return view('transactions.report', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
    public function index(Request $request)
    {
        $data = $request->validate([
            'to' => 'nullable|date',
            'from' => 'nullable|date',
        ]);
        $data['transactions'] = Transaction::betweenDates($data)->orderBy('created_at', 'DESC')->paginate(100);
        $data['income'] = Transaction::AllTransaction(config('app.categories.income.id'))->betweenDates($data)->orderBy('created_at', 'DESC')->get()->sum('amount');
        $data['savings'] = Transaction::AllTransaction(config('app.categories.savings.id'))->betweenDates($data)->orderBy('created_at', 'DESC')->get()->sum('amount');
        $data['expenses'] = Transaction::AllTransaction(config('app.categories.expenses.id'))->betweenDates($data)->orderBy('created_at', 'DESC')->get()->sum('amount');
        //return $data;
        return view('transactions.transaction_list', $data);
        //return view('transactions', $data);
    }

    public function getTypesByCategory($category_id)
    {
        $types = Type::where('category_id', $category_id)->get();
        return response()->json($types);
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
            'amount' => 'required|numeric',
            'name' => 'required|string',
            'date' => 'required',
            'category_id' => 'required|exists:categories,id',
            'type_id' => 'required|exists:types,id',
            'budget_id' => 'nullable|exists:budgets,id',
            'description' => 'nullable|string'
        ]);
        $user = auth()->user();
        //$business = $user->businesses->first();
        $data['date'] = \Carbon\Carbon::parse($request->date)->toDateTimeString();
        Transaction::create($data + [
            'user_id' => Auth::id(),
            'business_id' => $user->business_id
        ]);
        return back()->with('success', 'Transaction was registered successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function filter(Request $request)
    {
        if (isset($request->from) && isset($request->to)) {
            $to = $request->to;
            $from = $request->from;
            $transactions = Transaction::where('user_id', auth()->user()->id)->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'DESC')->get();
        } else {
        }

        return view('transactions', ['transactions' => $transactions, 'from' => $from, 'to' => $to]);
    }
}
