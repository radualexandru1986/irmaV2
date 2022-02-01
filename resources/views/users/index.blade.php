@extends('layouts.app')
@section('content')
    <div class="container-flex">
        <h1 class="display-4 w-auto">Users</h1>
        <hr>
        <div class="row  ">
            <div class="col-lg-6 col-12">
                <button class="btn btn-info "> <i class="bi bi-plus-square"></i> Add New User</button>
            </div>

            <div class="col-lg-6 col-12">
                <div class="input-group ">
                    <input type="text" class="form-control" id="autoSizingInputGroup" placeholder="Search User">
                    <div class="input-group-text"><i class="bi bi-search"></i></div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            @foreach($users as $user)
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$user->name}}</h5>
                            <p class="card-text">
                                @if($user->employee)
                                    Role : {{$user->employee->department->name}}
                                @endif
                            </p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        </div>
@endsection
