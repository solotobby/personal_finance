<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if($user->hasRole('admin')){
            return redirect('user');
        }
        $categories = Categories::all();
        $transactions = Transaction::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate('30');
        $tran = Transaction::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();//all();
        $budgets = Budget::where('user_id', auth()->user()->id)->get();
        return view('home', ['categories' => $categories, 'transactions' => $transactions, 'tran' =>$tran, 'budgets' => $budgets]);
    }

    public function dashboard()
    {
        $data['income'] = Transaction::filterCategory('Income')->get()->sum('amount');
        $data['savings'] = Transaction::filterCategory('Savings')->get()->sum('amount');
        $data['expenses'] = Transaction::filterCategory('Expenses')->get()->sum('amount');
        $data['transactions'] = Transaction::myLatest(5)->get();
        $data['categories'] = Categories::all();
        $data['budgets'] = Budget::where('user_id', auth()->user()->id)->get();
        return view('dashboard', $data);
    }


}
