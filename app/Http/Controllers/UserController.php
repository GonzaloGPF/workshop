<?php

namespace App\Http\Controllers;

use App\Filters\UsersFilter;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\User;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user()
    {
        return $this->showResponse(new UserResource(auth()->user()));
    }

    /**
     * Display a listing of the resource.
     *
     * @param UsersFilter $filters
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(UsersFilter $filters)
    {
        $users = User::latest()
            ->filter($filters)
            ->order($filters)
            ->getOrPaginate();

        return $this->indexResponse(UserResource::collection($users));
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        $this->loadRelations(request(), $user);

        return $this->showResponse(new UserResource($user));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserCreateRequest $request)
    {
        $user = User::make($request->all());

        $user->password = config('custom.default_user_pass');
        $user->save();

        return $this->storeResponse(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());

        return $this->updateResponse(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(UserUpdateRequest $request, User $user)
    {
        return $this->destroyResponse($user, new UserResource($user));
    }
}
