<?php

namespace App\Http\Controllers;

use App\Creators\Users\User;
use App\Http\Requests\ShiftStoreRequest;
use App\Models\Shift;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShiftController extends Controller
{

    /**
     * ShiftController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('shifts.index');
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
    public function store(\App\Creators\Shifts\Shift $shiftCreator, ShiftStoreRequest $request): mixed
    {
        $newShift = $shiftCreator->storeModel($request->validated());
        if ($request->wantsJson()) {
            return response()->json(
                [
                    'msg' => 'Shift created!',
                    'shift' => $newShift->id
                ]
            );
        }
        return redirect()->to('/shift');
    }

    /**
     * Display the specified resource.
     *
     * @param Shift $shift
     * @return Response
     */
    public function show(Shift $shift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Shift $shift
     * @return Response
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Shift $shift
     * @return Response
     * @throws Exception
     */
    public function update(int $id, \App\Creators\Shifts\Shift $shiftCreator, ShiftStoreRequest $request): mixed
    {
        $updatedShift = $shiftCreator->updateByReference($id, $request->validated());
        if ($request->wantsJson()) {
            return response()->json(
                [
                    'msg' => 'Shift Updated!',
                    'shift' => $updatedShift->id
                ]
            );
        }
        return redirect()->to('/shift');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shift $shift
     * @return Response
     */
    public function destroy(int $id, \App\Creators\Shifts\Shift $shiftCreator, Request $request): mixed
    {
        $result = $shiftCreator->destroyModel($id);
        if ($result) {
            if ($request->wantsJson()) {
                return response()->json(
                    [
                        'msg' => 'The shift was deleted!'
                    ]
                );
            }
        }

        return redirect()->to('shift');
    }
}
