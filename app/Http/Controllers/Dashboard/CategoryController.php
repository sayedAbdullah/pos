<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Validation\Rule;

// use Illuminate\Contracts\Validation\Rule;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-categories'])->only('read');
        $this->middleware(['permission:create-categories'])->only('create');
        $this->middleware(['permission:update-categories'])->only('edit');
        $this->middleware(['permission:delete-categories'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    $categories = Category::when($request->search, function($query) use ($request){
        return $query->where('name', 'like', '%'.$request->search.'%');
    })->paginate(5);

    return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];
        foreach(config('translatable.locales') as $locale ){
            $rules +=[$locale.'.name'=>['required',Rule::unique('category_translations','name')]];

        }
        // return dd($request->all());

        $request->validate($rules);
        // $request->validate([
        //     'en.name'    => 'required|unique:category_translations,name',
        // ]);

        $category = category::create($request->all());

        session()->flash('success',_('added successfully'));
        return redirect()->route('dashboard.categories.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {
        $rules = [];
        foreach(config('translatable.locales') as $locale ){
            $rules +=[$locale.'.name'=>['required',Rule::unique('category_translations','name')->ignore($category->id, 'category_id')]];

        }
        $request->validate($rules);
        // |unique:categories,name'.$category->id

        // $request->validate([
        //     'en*'    => 'required|unique:category_translations,name',
        // ]);
        $category->update($request->all());


        session()->flash('success',_('udpated successfully'));
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success',_('deleted successfully'));
        return redirect()->route('dashboard.categories.index');

    }
}
