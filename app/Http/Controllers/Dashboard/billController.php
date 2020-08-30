<?php

namespace App\Http\Controllers\Dashboard;

use App\Vendor;
use App\Http\Controllers\Controller;
use App\Bill;
use App\BillItem;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use PDF;
use PDF;

use function GuzzleHttp\Promise\all;

class billController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::paginate(10);
        return view('dashboard/bills/index',compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $vendors = Vendor::all();
        return view('dashboard.bills.create',compact('products','vendors'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id'    => 'required',
            'bill_number' => 'required|unique:bills',
            'due_at' => 'required',
            'status' =>'required',

        ]);
        
        // 'product'=>'required|array|!empty'

    
        $request['user_id']= Auth::user()->id;
        $request['status']= 'paid';
        $request['bill_number']= rand(0,1000);

        $amount =0;

        // for ($i=0; $i <=10  ; $i++) { 
        foreach ($request->product as $i => $item) {
            $item_id = explode("&",$request->product[$i])[0];
            $price = $request->price[$i];
            $quantity = $request->quantity[$i];
            $total = $price * $quantity;
            $amount+=$total;
            
            $items[] =[
                'item_id'   =>$item_id,
                'price'     =>$price,
                'quantity'  =>$quantity,
                'total'     =>$total
            ]; 
        }

        $request['amount']= $amount;
        // return ($request->all());

        $bill = bill::create($request->all());

        foreach ($items as $key => $item) {
            $item['bill_id']=$bill->id;
            $item['user_id']=Auth::user()->id;
            $item['name'] =Product::find($item['item_id'])->name;
            
            $rows[] = $item;

        }

        // return $request->all();

        // $bill = new bill;
        // $bill =$request->all();
        foreach ($rows as $key => $row) {
            BillItem::create($row);

        }
        return ' done';

        // $item 
        // $items['bill_id'] = $bill->id;


        // foreach ($request->product as $index => $item) {
        //     $BillItem = item;

        //     for ($i=0; $i <  ; $i++) { 
        //         # 
        //     }
        // }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = bill::find($id);
        // return $bill->transactions;
        $items = BillItem::where('bill_id',$id)->get();
        return view('dashboard/bills/show',compact('bill','items'));

    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $bill = bill::find($id);
        
        // return $bill->transactions;
        $items = BillItem::where('bill_id',$id)->get();
        // return $items;
        $pdf = PDF::loadView('dashboard.bills.pdf', $items);


        return view('dashboard.bills.pdf',compact('bill','items'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
