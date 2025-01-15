<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Type;
use App\Models\Categories;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        if ($user->hasRole('admin')) {
            return redirect('user');
        }
        $categories = Categories::all();
        $transactions = Transaction::where(
            'user_id',
            auth()->user()->id
        )->orderBy('created_at', 'DESC')->paginate('30');
        $tran = Transaction::where(
            'user_id',
            auth()->user()->id
        )->orderBy('created_at', 'DESC')->get(); //all();
        $budgets = Budget::where(
            'user_id',
            auth()->user()->id
        )->get();
        return view('home', [
            'categories' => $categories,
            'transactions' => $transactions,
            'tran' => $tran,
            'budgets' => $budgets
        ]);
    }

    public function dashboard()
    {

        $user = auth()->user();
        //$business = $user->businesses->first();

        $dates = $this->previousMonths(6);
        $firstDateIndex = $dates[0]['month_index'];
        $firstDateYear = $dates[0]['year'];

        $from = $firstDateYear . '-' . $firstDateIndex . '-01';
        $to = Carbon::now()->format('Y-m-01');

        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        $data['dates'] = $dates->map(function ($date) {
            return $date['month'] . ' ' . $date['year'];
        });
        $data['income_stat'] = $this->buildChatData(config('app.categories.income.id'), $dates);
        $data['savings_stat'] = $this->buildChatData(config('app.categories.savings.id'), $dates);
        $data['expenses_stat'] = $this->buildChatData(config('app.categories.expenses.id'), $dates);
        $data['income'] = Transaction::filterCategory(config('app.categories.income.id'), $month, $year)->sum('amount');
        $data['savings'] = Transaction::filterCategory(config('app.categories.savings.id'), $month, $year)->sum('amount');
        $data['expenses'] = Transaction::filterCategory(config('app.categories.expenses.id'), $month, $year)->sum('amount');
        $data['transactions'] = Transaction::myLatest(5)->get();
        $data['budgets'] = Budget::where('user_id', $user->id)->get();
        $data['categories'] = Categories::where(
            'business_id',
            $user->business_id
        )->get();
        $data['types'] = Type::whereIn(
            'category_id',
            $data['categories']->pluck('id')
        )->get();
        // $data['types'] = Type::pluck('name', 'id')->toArray();
        // $data['categories'] = Categories::pluck('name', 'id')->toArray();

        return view('dashboard', $data);
    }

    private function buildChatData($category, $dates)
    {
        if (config('database.default') == 'pgsql') {
            $amounts = DB::table('transactions')->where('user_id', auth()->user()->id)->where('category_id', $category)
                ->select(DB::raw('EXTRACT(MONTH FROM date) as month, EXTRACT(YEAR FROM date) as year'), DB::raw('SUM(transactions.amount) as data'))
                ->whereRaw("date > (now() - INTERVAL '10 MONTH')")->groupBy('year', 'month')->get();
        } else {
            $amounts = DB::table('transactions')->where('user_id', auth()->user()->id)->where('category_id', $category)
                ->select(DB::raw('MONTH(date) as month, YEAR(date) as year'), DB::raw('SUM(transactions.amount) as data'))
                ->whereRaw('date > DATE_SUB(now(), INTERVAL 10 MONTH)')->groupBy('year', 'month')->get();
        }

        return $dates->map(function ($date) use ($amounts) {

            $data = $amounts->filter(function ($amount) use ($date) {
                return $amount->month == $date['month_index'] && $amount->year == $date['year'];
            })->first();

            return $data->data ?? 0;
        });
    }

    private function previousMonths($range)
    {
        $data = collect(range($range - 1, 0));

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
