<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Vendor;

class VendorController extends Controller
{
    public function index(Request $request)
    {
        $vendors = Vendor::when($request->search, function($q) use ($request){

            return $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');

        })->latest()->paginate(5);

        return view('dashboard.vendors.index', compact('vendors'));

    }//end of index

    public function create()
    {
        return view('dashboard.vendors.create');

    }//end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);

        Vendor::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.vendors.index');

    }//end of store

    public function edit(Vendor $vendor)
    {
        return view('dashboard.vendors.edit', compact('vendor'));

    }//end of edit

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);

        $vendor->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.vendors.index');

    }//end of update

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.vendors.index');

    }//end of destroy

}//end of controller

