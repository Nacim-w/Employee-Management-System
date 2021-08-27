<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $roles=Role::all();
        
        if($request->has('search')){
            $roles=Role::where('name','like',"%{$request->search}%")->get();
        }
        return view('roles.index',compact("roles"));
    }
    public function create()
    {
        return view('roles.created');
       
    }
    public function Store(RoleStoreRequest $request,Role $role)
    {
        Role::create($request->validated());
        return redirect()->route('roles.index')->with('message','Role Added!')->with('message_status', 'success');     
    }
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
    
        ]);
        return redirect()->route('roles.index')->with('message','Role Updated!')->with('message_status', 'success');
    }
    public function destroy(Role $role)
    {
       
        $role->delete();
        return redirect()->route('roles.index')->with('message','Role Deleted');

    }
}
