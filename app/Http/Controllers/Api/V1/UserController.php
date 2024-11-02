<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeleteUserRequest;
use App\Http\Requests\V1\ShowUsersRequest;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(ShowUsersRequest $request): UserCollection
    {
        $filter = new  UserFilter();
        $filterItems = $filter->transform( $request);//[['column','operator','value']]


        $users = User::where($filterItems);


        return new UserCollection($users->paginate()->appends($request->query()));
    }

    public function store(StoreUserRequest $request): \Illuminate\Http\JsonResponse|UserResource
    {
        $userData = $request->validated();
        $userData['password'] = Hash::make($userData['password']);
        $user = User::create($userData);
        $token = $user->createToken('API Token',['delete:customer','create:customer','update:customer','create:invoice','delete:invoice','update:invoice'])->plainTextToken;
        return (new UserResource($user))->additional(['token' => $token]);
    }
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }
    public function update(UpdateUserRequest $request, User $user): void
    {
        $user->update($request->all());
    }

    public function destroy(User $user,DeleteUserRequest $request): \Illuminate\Http\Response
    {
        if ($user->delete()) {
            return response(['deleted' => true]);
        }

        return response(['deleted' => false], 500);
    }

}
