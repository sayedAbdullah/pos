<?php

namespace App\Http\Controllers\Dashboard;

use App\Bill;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Transaction;
use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $categories = Category::all();

        $transactions =Transaction::when($request->from, function($query) use ($request){

            return $query->where('paid_at','>'.$request->from);

        })->when($request->to, function($q) use ($request) {

            return $q->where('paid_at','<',$request->to);

        })->paginate(50);

        // return view('dashboard.products.index', compact('products','categories'));

        // $transactions = Transaction::all();
        $sum_income = $transactions->where('type','income')->sum('amount');
        $sum_expense = $transactions->where('type','expense')->sum('amount');
        return  view('dashboard.transactions.index',compact('transactions','sum_income','sum_expense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request,$id)
    {
        $route = $request->route()->getName();
        if ($route=='dashboard.invoices.transactions.create'){

            $invoice = Invoice::find($id);
            return view('dashboard.transactions.invoices.create',compact('invoice'));

        }elseif($route=='dashboard.bills.transactions.create'){

            $bill = Bill::find($id);
            return view('dashboard.transactions.bills.create',compact('bill'));    

        }
        return $route;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'first_name'    => 'required',
        //     'last_name'     => 'required',
        //     'email'         => 'required|unique:users',
        //     'password'      => 'required|confirmed',
        // ]);
        $user_id= Auth::user()->id;

        $route = $request->route()->getName();

        if ($route=='dashboard.invoices.transactions.store'){

            Transaction::create(array_merge($request->all(),['user_id'=>$user_id,'type'=>'income']));

        }elseif($route=='dashboard.bills.transactions.store'){

            Transaction::create(array_merge($request->all(),['user_id'=>$user_id,'type'=>'expense']));

        }

        

        return redirect(route('dashboard.transactions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transactions = Transaction::where($id);
        return view('dashboard.transactions.index',compact('transactions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
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
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
