<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users  = User::withTrashed()->get();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
       // User::crete($request->all());
       $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required',
        'surname'=>'required',
        'address'=>'required',
    ]);
       // dd();
        User::create($request->all());
       return redirect()->route('users.index')->with('success','updated inserted..');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
       // dd($user);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // $data = $request->all();
        // dd($data);
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'password'=>'nullable',
            'surname'=>'required',
            'address'=>'required',
        ]);
        $data = $request->all();
        if ($request->filled('password')) {
            $data['password '] = bcrypt($data['password']);
         }
         else {
            unset($data['password ']);
         }

        $user->update($request->all());
        return redirect()->route('users.index')->with('success','updated successfully..');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','successfully deleted the user.');

    }

    public function restore($user)
    {
        //dd('working..');
        $myuser = User::withTrashed()->findOrFail($user);
        $myuser->restore();
        return redirect()->route('users.index')->with('success','successfully deleted the user.');

    }
}
