<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $employees  = Employee::with(['user', 'department', 'contract'])->paginate(20);
        return view('employees.index', ['employees' => $employees, ]);
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
    public function store(StoreEmployeeRequest $request, \App\Creators\Employees\Employee $employeeCreator)
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
     * @return Response
     */
    public function show(Employee $employee)
    {
        //
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
