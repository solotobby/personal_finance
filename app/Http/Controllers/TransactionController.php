<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Couchbase\basicDecoderV1;

class TransactionController extends Controller
{
    public function summary()
    {
        $data['income'] = Transaction::filterCategory('Income')->get()->sum('amount');
        $data['savings'] = Transaction::filterCategory('Savings')->get()->sum('amount');
        $data['expenses'] = Transaction::filterCategory('Expenses')->get()->sum('amount');
        $data['transactions'] = Transaction::myLatest(5)->get();
        $data['categories'] = Categories::all();
        $data['budgets'] = Budget::where('user_id', auth()->user()->id)->get();
        return view('transactions.summary', $data);
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
        return view('transactions', $data);
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
            'transaction_date' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string'
        ]);

        $category = Categories::findOrFail($request->category_id);

        $data['user_id'] = Auth::id();
        $data['transaction_date'] = \Carbon\Carbon::parse($request->transaction_date)->format('y-m-d h:i:s');
        $data['category'] = $category->name;
        $data['type'] = $category->type;

        Transaction::create($data);
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
        if(isset($request->from) && isset($request->to)) {
            $to = $request->to;
            $from = $request->from;
            $transactions = Transaction::where('user_id', auth()->user()->id)->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'DESC')->get();
        }else{}

        return view('transactions', ['transactions' => $transactions, 'from' => $from, 'to' => $to]);

    }
}
