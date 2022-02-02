@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <h1 class="display-4"> Edit </h1>
        <hr>
        <div class="row">
            <div class="col-12 col-xl-10 col-xxl-6 mx-auto">
                <div class="card p-4">
                    <div class="card-title w-100 text-center">
                       <h1>{{ $employee->user->name }}</h1>
                        <small>{{$employee->active}}</small>
                    </div>
                    <div class="card-body">
                        @include('shared.employee-users-form')
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-10 col-xxl-6 mx-auto">
                <div class="card p-4 h-100">
                    <div class="card-title w-100 text-center">
                       <h1> Settings </h1>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
