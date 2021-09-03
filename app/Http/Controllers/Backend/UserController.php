<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
   
     $users=User::all();
     if($request->has('search')){
         $users=User::where('username','like',"%{$request->search}%")->orWhere('email','like',"%{$request->search}%")->orWhere('first_name','like',"%{$request->search}%")->orWhere('last_name','like',"%{$request->search}%")->orWhere('email','like',"%{$request->search}%")->get();
     }
     if(Gate::allows('is-admin')){

     return view('users.index', compact ('users'));
    }
    return view('employees.index', compact ('users'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('users.created',['roles'=>Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
     $user=   User::create($request->except(['_token','roles']));
     $user->roles()->sync($request->roles);      
       return redirect()->route('users.index')->with('message','User Registered!')->with('message_status', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('users.edit', 
        [
            'roles'=>Role::all(),
            'user'=>User::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->except(['_token','roles']));
        $user->roles()->sync($request->roles);       
        return redirect()->route('users.index')->with('message','User Edited!')->with('message_status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->user()->id==$user->id){
            return redirect()->route('users.index')->with('message','You Cant Delete Yourself');
        }
        $user->delete();
        return redirect()->route('users.index')->with('message','User Deleted');

    }
}
