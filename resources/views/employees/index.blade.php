@extends('layouts.app')
@section('content')
    <div class="container-fluid">
            <h1 class="display-4">Employees</h1>
            <hr>
        <div class="row  ">
            <div class="col-lg-6 col-12">
                <button class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="bi bi-plus-square"></i> Add New Employee</button>
            </div>


        </div>

        <div class="row my-3">
            <table class="table table-striped" id="dataTable">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Department</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contract</th>
                    <th scope="col">Edit</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <th scope="row">{{$employee->id}}</th>
                        <td>{{$employee->user->name}}</td>
                        <td>{{$employee->user->getRole()}}</td>
                        <td>{{$employee->department->name}}</td>
                        <td>{{$employee->user->telephone}}</td>
                        <td>{{$employee->user->email}}</td>
                        <td>{{data_get($employee, 'contract.hours')}} hours / week</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{route('employee.show', [$employee->id])}}" style="cursor:pointer">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('employee.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label"> Name </label>
                                <input name="name" type="text" class="form-control" placeholder="Employee Name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> Email </label>
                                <input name="email" type="email" class="form-control" placeholder="@ Email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> Phone </label>
                                <input name="telephone" type="text" class="form-control" placeholder="Telephone number">
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label"> Contract </label>
                                    <select name="contract_id" id="inputState" class="form-select">
                                        @foreach( $contracts as $contract )
                                            <option value="{{ $contract->id }}" > {{ $contract->name }} - {{$contract->hours}}h / week</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col">
                                    <label class="form-label"> Department </label>
                                    <select name="department_id" id="inputState" class="form-select">
                                        @foreach( $departments as $department )
                                            <option value="{{ $department->id }}" >{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="form-label"> Role </label>
                                    <select name="role_id" id="inputState" class="form-select">
                                        @foreach( $roles as $role )
                                            <option value="{{ $role->id }}" >{{ ucfirst($role->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row m-0">
                                <button class="btn btn-info">
                                    Save changes
                                </button>
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        } );
    </script>
@endpush
