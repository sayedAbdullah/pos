<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-products'])->only('read');
        $this->middleware(['permission:create-products'])->only('create');
        $this->middleware(['permission:update-products'])->only('edit');
        $this->middleware(['permission:delete-products'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $products =Product::when($request->search, function($query) use ($request){

            return $query->whereTranslationLike('name','%'.$request->search.'%');

        })->when($request->category_id, function($q) use ($request) {

            return $q->where('category_id',$request->category_id);

        })->paginate(5);

        return view('dashboard.products.index', compact('products','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id'   =>'required',
            'purchase_price'=>'required',
            'sale_price'    =>'required',
            'stock'         =>'required',

        ];

        foreach(config('translatable.locales') as $locale ){
            $rules +=[$locale.'.name'=>['required',Rule::unique('product_translations','name')]];
            $rules +=[$locale.'.description'=>['required',Rule::unique('product_translations','name')]];

        }
        $request->validate($rules);


        $product = product::create($request->all());

        session()->flash('success',_('added successfully'));
        return redirect()->route('dashboard.products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('dashboard.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        $rules = [];
        foreach(config('translatable.locales') as $locale ){
            $rules +=[$locale.'.name'=>['required',Rule::unique('product_translations','name')->ignore($product->id, 'product_id')]];

        }
        $request->validate($rules);

        $product->update($request->all());


        session()->flash('success',_('udpated successfully'));
        return redirect()->route('dashboard.products.index');
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
