<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request, \App\Creators\Employees\Employee $employeeCreator)
    {
        $newEmployee = $employeeCreator->storeModel($request->validated());
        if($request->wantsJson()){
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(int $id, StoreEmployeeRequest $request, \App\Creators\Employees\Employee $employeeCreator)
    {
        $updatedEmployee = $employeeCreator->updateByReference($id, $request->validated() );
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, Request $request, \App\Creators\Employees\Employee $employeeCreator)
    {
        $employeeCreator->destroyModel($id);
        if($request->wantsJson()) {
            return response()->json([
                'msg' => 'Your employee is now destroyed !'
            ]);
        }

        return redirect()->back();
    }
}
