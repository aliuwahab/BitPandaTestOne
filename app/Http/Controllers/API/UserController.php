<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIsBaseController;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use BitPanda\UserProfile\UserProfileRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends APIsBaseController
{
    private UserProfileRepositoryInterface $userProfileRepositoryInterface;

    public function __construct(UserProfileRepositoryInterface $userProfileRepositoryInterface)
    {
        $this->userProfileRepositoryInterface = $userProfileRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $filters = $request->all();

        $filteredUsers = $this->userProfileRepositoryInterface->filterBy($filters);

        return $this->success(UserProfileResource::collection($filteredUsers), 200, 'Users retrieved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return $this->success($user, 200, 'User retrieved successfully!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {

        return $this->success($user, 200, 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }
}
