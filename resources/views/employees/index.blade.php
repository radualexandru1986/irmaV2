@extends('layouts.app')
@section('content')
    <div class="container-fluid">
            <h1 class="display-4">Employees</h1>
            <hr>
        <div class="row  ">
            <div class="col-lg-6 col-12">
                <button class="btn btn-info "> <i class="bi bi-plus-square"></i> Add New Employee</button>
            </div>

            <div class="col-lg-6 col-12">
                <div class="input-group ">
                    <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Search User">
                    <div class="input-group-text"><i class="bi bi-search"></i></div>
                </div>
            </div>
        </div>

        <div class="row my-3">
            @foreach($employees as $employee)
                <div class="col-lg-3 col-md-4 p-2">
                    <div class="card">
                        <div class="card-body w-100">
                            <h5 class="card-title">{{$employee->user->name}}</h5>
                            <p class="card-text">Department : {{$employee->department->name}}</p>
                            <p class="card-text"> Contract : {{data_get($employee, 'contract.hours')}} hours / week</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
