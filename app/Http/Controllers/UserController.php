<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(Request $request)
    {
        return $this->userService->createUser($request->all());
    }

    public function updateUser(Request $request)
    {
        $userEmail = $request->email;
        return $this->userService->updateUser($request->all(), $userEmail);

    }

    public function login(Request $request)
    {
        $userEmail = $request->email;
        $userPassword = $request->password;
        return $this->userService->login($userEmail, $userPassword);
    }

    public function resetPassword(Request $request)
    {
        $userEmail = $request->email;
        return $this->userService->resetPassword($userEmail);
    }
}
