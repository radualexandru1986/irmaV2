<?php

namespace App\Http\Controllers;

use App\Creators\Users\User;
use App\Models\Contract;
use App\Models\Department;
use App\Models\User as UserModel;
use App\Http\Requests\StoreUserRequest;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        //$users =  UserModel::with(['employee', 'employee.department'])->get();
        $users = UserModel::with('employee')
            ->get()
            ->loadMorph('employee', [
                Department::class => ['department'],
                Contract::class => ['contract']
            ]);
        return view('users.index', ['users'=>$users]);
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
        if ($request->wantsJson()) {
            return response()->json(
                [
                    'msg' => 'Well Done',
                    'user' => $newUser->id
                ]
            );
        }
        return redirect()->to('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(int $id, StoreUserRequest $request, User $user): mixed
    {
        $updatedUser = $user->updateByReference($id, $request->validated());
        if ($request->wantsJson()) {
            return response()->json(
                [
                    'msg' => 'The user details are saved',
                    'userId' => $updatedUser->id
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
     * @return Response
     * @throws Exception
     */
    public function destroy(int $id, User $user, Request $request): mixed
    {
        $result = $user->destroyModel($id);
        if ($result) {
            if ($request->wantsJson()) {
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
