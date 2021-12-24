<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Creators\Contracts\Contract as ContractCreator;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contracts.index');
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
    public function store(StoreContractRequest $request, ContractCreator $contract): mixed
    {
        $newContract = $contract->storeModel($request->validated());
        if($request->wantsJson()){
            return response()->json(
                [
                    'msg'=>'Your contract is saved!',
                    'contract' => $newContract->id
                ]
            );
        }
        return redirect()->to('contract');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update($id, StoreContractRequest $request, ContractCreator $contractCreator): mixed
    {
        $updatedContract = $contractCreator->updateByReference($id, $request->validated());
        if($request->wantsJson()){
            return response()->json(
                [
                    'msg'=>'Your contract is updated!',
                    'contract' => $updatedContract->id
                ]
            );
        }

        return redirect()->to('contract');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, ContractCreator $contract, Request $request):mixed
    {
        $contract->destroyModel($id);

        if ($request->wantsJson()){
            return response()->json(
                [
                    'msg'=>'The contract is now destroyed!'
                ]
            );
        }

        return redirect()->to('contract');
    }
}
