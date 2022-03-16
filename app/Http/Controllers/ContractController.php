<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Models\Contract;
use Exception;
use Illuminate\Http\Request;
use App\Creators\Contracts\Contract as ContractCreator;
use Illuminate\Http\Response;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('contracts.index');
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
    public function store(StoreContractRequest $request, ContractCreator $contract): mixed
    {
        $newContract = $contract->storeModel($request->validated());
        if ($request->wantsJson()) {
            return response()->json(
                [
                    'msg' => 'Your contract is saved!',
                    'contract' => $newContract->id
                ]
            );
        }
        return redirect()->to('contract');

    }

    /**
     * Display the specified resource.
     *
     * @param Contract $contract
     * @return Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Contract $contract
     * @return Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @param StoreContractRequest $request
     * @param ContractCreator $contractCreator
     * @return Response
     * @throws Exception
     */
    public function update($id, StoreContractRequest $request, ContractCreator $contractCreator): mixed
    {
        $updatedContract = $contractCreator->updateByReference($id, $request->validated());
        if ($request->wantsJson()) {
            return response()->json(
                [
                    'msg' => 'Your contract is updated!',
                    'contract' => $updatedContract->id
                ]
            );
        }

        return redirect()->to('contract');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contract $contract
     * @return Response
     */
    public function destroy(int $id, ContractCreator $contract, Request $request): mixed
    {
        $contract->destroyModel($id);

        if ($request->wantsJson()) {
            return response()->json(
                [
                    'msg' => 'The contract is now destroyed!'
                ]
            );
        }

        return redirect()->to('contract');
    }
}
