<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Categories;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $dates = $this->previousMonths(10);
        $data['dates'] = $dates->map(function ($date) { return $date['month']. ' ' . $date['year'];});
        $data['income_stat'] = $this->buildChatData('Income', $dates);
        $data['savings_stat'] = $this->buildChatData('Savings', $dates);
        $data['expenses_stat'] = $this->buildChatData('Expenses', $dates);
        $data['income'] = Transaction::filterCategory('Income')->get()->sum('amount');
        $data['savings'] = Transaction::filterCategory('Savings')->get()->sum('amount');
        $data['expenses'] = Transaction::filterCategory('Expenses')->get()->sum('amount');
        $data['transactions'] = Transaction::myLatest(5)->get();
        $data['categories'] = Categories::all();
        $data['budgets'] = Budget::where('user_id', auth()->user()->id)->get();
        return view('dashboard', $data);
    }

    private function buildChatData($category, $dates)
    {
        if(config('database.default') == 'pgsql')
        {
            $amounts = DB::table('transactions')->where('user_id', auth()->user()->id)->where('category', $category)
                ->select(DB::raw('EXTRACT(MONTH FROM transaction_date) as month, EXTRACT(YEAR FROM transaction_date) as year'), DB::raw('SUM(transactions.amount) as data'))
                ->whereRaw("transaction_date > DATE_SUB(now(), INTERVAL '10 MONTH')")->groupBy('year', 'month')->get();
        }else{
            $amounts = DB::table('transactions')->where('user_id', auth()->user()->id)->where('category', $category)
                ->select(DB::raw('MONTH(transaction_date) as month, YEAR(transaction_date) as year'), DB::raw('SUM(transactions.amount) as data'))
                ->whereRaw('transaction_date > DATE_SUB(now(), INTERVAL 10 MONTH)')->groupBy('year', 'month')->get();
        }

        return $dates->map(function ($date) use($amounts) {

            $data = $amounts->filter(function($amount) use($date) {
                return $amount->month == $date['month_index'] && $amount->year == $date['year'];
            })->first();

            return $data->data ?? 0;
        });

    }

    private function previousMonths($range)
    {
        $data = collect(range($range - 1 , 0));

        return $data->map(function ($i) {
            $dt = today()->startOfMonth()->subMonth($i);

            return [
                'month_index' => $dt->format('m'),
                'month' => $dt->format('M'),
                'year' => $dt->format('Y')
            ];
        });

    }


}
