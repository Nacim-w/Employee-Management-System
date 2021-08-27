<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
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
         $users=User::where('username','like',"%{$request->search}%")->orWhere('email','like',"%{$request->search}%")->orWhere('first_name','like',"%{$request->search}%")->orWhere('last_name','like',"%{$request->search}%")->get();
     }
     return view('users.index', compact ('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('users.created');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        User::create([
            'username' => $request->username,
            'first_name' =>$request->first_name,
            'last_name' => $request->last_name,
            'email' =>$request->email,  
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('users.index')->with('message','User Registered!')->with('message_status', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
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
        $user->update([
            'username' => $request->username,
            'first_name' =>$request->first_name,
            'last_name' => $request->last_name,
            'email' =>$request->email,  

        ]);
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
