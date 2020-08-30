<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\InvoiceItem;
use App\Product;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use PDF;
use PDF;

use function GuzzleHttp\Promise\all;

class invoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::paginate(100);
        return view('dashboard/invoices/index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $clients = Client::all();
        return view('dashboard.invoices.create',compact('products','clients'));

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
            'client_id'    => 'required',
            'invoice_number' => 'required|unique:invoices',
            'due_at' => 'required',
            'status' =>'required',

        ]);

        // return $request ;
        // 'product'=>'required|array|!empty'

    
        $request['user_id']= Auth::user()->id;
        // $request['status']= 'paid';
        // $request['invoice_number']= rand(0,1000);


        $amount =0;
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
        if($request->status=='partial' && $request->paid > $amount){
            return 'error';
            return redirect()->back();
        }

        $request['amount']= $amount;
        // return ($request->all());

        $invoice = invoice::create($request->all());

        foreach ($items as $key => $item) {
            $item['invoice_id']=$invoice->id;
            $item['user_id']=Auth::user()->id;
            $item['name'] =Product::find($item['item_id'])->name;
            
            $rows[] = $item;

        }

        // return $request->all();

        // $invoice = new invoice;
        // $invoice =$request->all();
        foreach ($rows as $key => $row) {
            InvoiceItem::create($row);

        }

        //payment

        if($request->status=='paid'){
            Transaction::create([
                'user_id'=>$request['user_id'],
                'type'=>'income',
                'amount'=>$request['amount'],
                'paid_at'=>$request['invoiced_at'],
                'document_id'=>$invoice->id

                ]);
            return 'paid';
        }elseif($request->status=='partial' &&  !empty($request->paid)){
            Transaction::create([
                'user_id'=>$request['user_id'],
                'type'=>'income',
                'amount'=>$request['paid'],
                'paid_at'=>$request['invoiced_at'],
                'document_id'=>$invoice->id

                ]);
        }
        

        return ' done';



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = invoice::find($id);
        // return $invoice->transactions;
        $items = InvoiceItem::where('invoice_id',$id)->get();
        return view('dashboard/invoices/show',compact('invoice','items'));

    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $invoice = invoice::find($id);
        
        // return $invoice->transactions;
        $items = InvoiceItem::where('invoice_id',$id)->get();
        // return $items;
        $pdf = PDF::loadView('dashboard.invoices.pdf', $items);


        return view('dashboard.invoices.pdf',compact('invoice','items'));

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
