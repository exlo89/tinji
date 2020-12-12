<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display the specified resource.
     *
     * @return UserResource
     */
    public function getProfile()
    {
        /** @var User $user */
        $user = auth('api')->user();
        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     *
     * @return SettingResource
     */
    public function getSetting()
    {
        /** @var User $user */
        $user = auth('api')->user();
        return SettingResource::make($user->setting);
    }

}
