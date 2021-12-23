<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Creators\Departments\Department as DepartmentCreator;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('departments.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(DepartmentCreator $department, StoreDepartmentRequest $request ): mixed
    {
        $newDepartment = $department->storeModel($request->validated());
        if($request->wantsJson()){
            return response()->json(
                [
                    'msg'=>'Well Done!',
                    'user' => $newDepartment->id
                ]
            );
        }
        return redirect()->to('/department');
    }

    /**
     * Display the specified resource.
     *
     * @param Department $department
     * @return Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Department $department
     * @return Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param StoreDepartmentRequest $request
     * @param Department $department
     * @return Response
     */
    public function update($id, StoreDepartmentRequest $request, Department $department): mixed
    {
        $updatedDepartment = $department->updateByReference($id, $request->validated());
        if($request->wantsJson()){
            return response()->json(
                [
                    'msg'=>'The department details are saved!',
                    'userId'=>$updatedDepartment->id
                ]
            );
        }
        return redirect()->to('/department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @param Request $request
     * @param Department $department
     * @return Response
     */
    public function destroy($id, Request $request, DepartmentCreator $department): mixed
    {
        $result = $department->destroyModel($id);
        if ($result) {
            if($request->wantsJson()) {
                return response()->json(
                    [
                        'msg' => 'The department was deleted'
                    ]
                );
            }
        }

        return redirect()->to('user');
    }
}
