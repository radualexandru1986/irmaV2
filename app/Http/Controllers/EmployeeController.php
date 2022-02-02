<?php

namespace App\Http\Controllers;

use App\Creators\Users\User;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    /**
     * @return
     */
    public function index()
    {
        $employees  = Employee::with(['user', 'department', 'contract'])->get();
        return view('employees.index', [
            'contracts' => Contract::all(),
            'departments' => Department::all(),
            'roles' => Role::all(),
            'employees' => $employees,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreEmployeeRequest $request, \App\Creators\Employees\Employee $employeeCreator, User $userCreator)
    {
        $newEmployee = $employeeCreator->storeModel($request->validated());

        if ($request->wantsJson()) {
            return response()->json(
                [
                    'msg' => 'Your employee is saved',
                    'employee' => $newEmployee->id
                ]
            );
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Employee $employee
     */
    public function show(Employee $employee)
    {
        return view('employees.viewEmployee', [
            'employee'=> $employee,
            'departments'=>Department::all(),
            'contracts'=>Contract::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Employee $employee
     * @return Response
     * @throws Exception
     */
    public function update(int $id, StoreEmployeeRequest $request, \App\Creators\Employees\Employee $employeeCreator)
    {
        $updatedEmployee = $employeeCreator->updateByReference($id, $request->validated());
        if ($request->wantsJson()) {
            return response()->json([
                'msg' => 'Your employee is updated!',
                'employee' => $updatedEmployee->id
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return Response
     */
    public function destroy(int $id, Request $request, \App\Creators\Employees\Employee $employeeCreator)
    {
        $employeeCreator->destroyModel($id);
        if ($request->wantsJson()) {
            return response()->json([
                'msg' => 'Your employee is now destroyed !'
            ]);
        }

        return redirect()->back();
    }
}
