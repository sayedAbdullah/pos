<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-users'])->only('read');
        $this->middleware(['permission:create-users'])->only('create');
        $this->middleware(['permission:update-users'])->only('edit');
        $this->middleware(['permission:delete-users'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = User::all();
        // $users = User::whereRoleIs('admin')->get();
        //return $request->search;
        $users = User::whereRoleIs('admin')->when($request->search, function($query) use ($request){
                return $query->where('first_name', 'like', '%'.$request->search.'%')
                ->orWhere('last_name', 'like', '%'.$request->search.'%');
            })->paginate(5);
        // $users = User::whereRoleIs('admin')->where(function($q) use ($request) {
        //     return $q->when($request->search, function($query) use ($request){
        //         return $query->where('first_name', 'like', '%'.$request->search.'%')
        //         ->orWhere('last_name', 'like', '%'.$request->search.'%');
        //     });

        // })->get();

        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->permissions;
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|unique:users',
            'password'      => 'required|confirmed',
        ]);
        if($request->image){
            $img = Image::make($request->image);
            // resize the image to a width of 300 and constrain aspect ratio (auto height)
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('aa'));
        }

        $request_date= $request->except(['password', 'password_confirmation', 'permissions', 'image']);
        $request_date['password'] = Hash::make($request->password);

        $user = User::create($request_date);
        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success',_('added successfully'));
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required',
        ]);

        $request_date= $request->except(['permissions']);

        $user->update($request_date);

        $user->syncPermissions($request->permissions);

        session()->flash('success',_('udpated successfully'));
        return redirect()->route('dashboard.users.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success',_('deleted successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
