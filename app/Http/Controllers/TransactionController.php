<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Http\Request;
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
        
        if(isset($request->from) && isset($request->to)) {
            $to = $request->to;
            $from = $request->from;
            $transactions = Transaction::where('user_id', auth()->user()->id)->whereBetween('transaction_date', [$from, $to])
            ->orderBy('created_at', 'DESC')->paginate(1000);
        }else{
            $from = \Carbon\Carbon::now();
            $to = \Carbon\Carbon::now()->format('d/m/y');
            $transactions = Transaction::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(50);
        }
        return view('transactions', ['transactions' => $transactions, 'from' => $from, 'to' => $to]);

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
        $this->validate($request, [
            'amount' => 'required|numeric',
            'name' => 'required|string',
        ]);
        $cate = Categories::find($request->category_id);
        Transaction::create(['user_id' => auth()->user()->id, 'transaction_date' => $request->transaction_date, 'name' => $request->name, 'amount' => $request->amount,
            'category_id' => $request->category_id, 'category' => $cate->name, 'type' => $cate->type, 'description' => $request->description ]);
        return back()->with('success', 'Transaction successful');

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
