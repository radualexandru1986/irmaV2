<?php

namespace App\Http\Controllers;

use App\Creators\Users\User;
use App\Http\Requests\StoreUserRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * UsersController constructor.
     */
    public function __construct()
    {

        //checks if the user is authenticated
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('users.index');
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
     * This accepts a POST request
     * Store a newly created resource in the database and redirects the user back to its create form.
     * If the CONTENT_TYPE  is set to string/json in the request from the client then the response is going to be a JSON
     * Otherwise the user will be redirected back to request origin.
     *
     * @param User $user
     * @param StoreUserRequest $request
     * @return mixed
     * @throws Exception
     */
    public function store(User $user, StoreUserRequest $request): mixed
    {
        $newUser = $user->storeModel($request->validated());
        if($request->wantsJson()){
            return response()->json(
                [
                    'msg'=>'Well Done',
                    'user' => $newUser->id
                ]
            );
        }
        return redirect()->to('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     */
    public function update(int $id, StoreUserRequest $request, User $user ): mixed
    {
        $updatedUser = $user->updateByReference($id, $request->validated());
        if($request->wantsJson()){
            return response()->json(
                [
                    'msg'=>'The user details are saved',
                    'userId'=>$updatedUser->id
                ]
            );
        }
        return redirect()->to('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws Exception
     */
    public function destroy(int $id, User $user, Request $request): mixed
    {
        $result = $user->destroyModel($id);
        if ($result) {
            if($request->wantsJson()) {
                return response()->json(
                    [
                        'msg' => 'The user was deleted'
                    ]
                );
            }
        }

        return redirect()->to('user');
    }
}
