<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeesStoreRequest;
use App\Models\Employee;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Role;
class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees=Employee::all();
        if($request->has('search')){
            $employees=Employee::where('username','like',"%{$request->search}%")->orWhere('email','like',"%{$request->search}%")->orWhere('first_name','like',"%{$request->search}%")->orWhere('last_name','like',"%{$request->search}%")->orWhere('date_of_birth','like',"%{$request->search}%")->get();
        }
        return view('employees.index', compact ('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();

        return view('employees.created',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request)
    
        {
           
           Employee::create($request->validated());
            return redirect()->route('employees.index')->with('message','Employee Registered!')->with('message_status', 'success');

        }

    

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeStoreRequest $request, Employee $employee)
    {
        $employee->update([
            'username' => $request->username,
            'first_name' =>$request->first_name,
            'last_name' => $request->last_name,
            'email' =>$request->email,  
            'address' =>$request->address, 
            'date_of_birth' =>$request->date_of_birth, 

        ]);
        return redirect()->route('employees.index')->with('message','Employee Edited!')->with('message_status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        
        $employee->delete();
        return redirect()->route('employees.index')->with('message','Employee Deleted');
    }
}
