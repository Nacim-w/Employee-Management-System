@extends('layouts.main')
@section('content')


 <!-- Page Heading -->
 <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Employees</h1>    
</div>
<div class="row">
<div class="card mx-auto">
        <div>@if (session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
        </div>
    <div class="card-header"> 
        <div class="row">
            <div class="col">
                 <form method="GET" action="{{route('employees.index')}}">
                    <div class="form-row align-items-center">
                        <div class="col$">
                             <input type="search" name="search"class="form-control mb-2" id="inlineFormInput" placeholder="Search">
                        </div>
                    <div class="col">
                         <button type="submit" class="btn btn-primary mb-2">Search</button>
                 </div>
            </div>
            </form>
            </div>
        <div>
        <a href="{{route('employees.create')   }}" class="btn btn-primary mb-2">Create </a>
 
    </div>    
</div>
    </div>


  <div class="card body">
  <table class="table">
   <thead>
       <tr>
          <th scope="col">#</th>
          <th scope="col">User Name</th>   
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Date Of Birth</th>
          <th scope="col">Manage</th>
       </tr>
   </thead>
      <tbody>
          @foreach($employees as $employee)
          <tr>
                <th scope="row">{{$employee->id}}</th>
                <td> {{$employee->username}}</td>
                <td> {{$employee->first_name}}</td>
                <td> {{$employee->last_name}}</td>
                <td> {{$employee->email}}</td>
                <td> {{$employee->date_of_birth}}</td>
             <td>
                 <a href="{{route('employees.edit',$employee->id)}}" class="btn btn-success">Edit</a>
            </td> 
         </tr>
         @endforeach
      </tbody>
  </table>
   </div>
  </div>
</div>
@endsection