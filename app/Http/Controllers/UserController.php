<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Validator;

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
        return $this->userService->updateUser($request->all());

    }

    public function listUser(Request $request)
    {
        return $this->userService->listUser();

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|exists:user_details,user_id',
            'password' => [
                'required',
                'min:6',
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'regex:/[a-z]/', // must contain at least one lowercase letter
                'regex:/[!@#$%^&*(),.?":{}|<>]/', // must contain at least one special character
            ],
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $user_id = $request->user_id;
        $userPassword = $request->password;
        return $this->userService->login($user_id, $userPassword);
    }
    
    

    public function resetPassword(Request $request)
    {
        $user_id = $request->user_id;
        return $this->userService->resetPassword($user_id);
    }

    public function deleteUser(Request $request)
    {
        $user_id = $request->user_id;
        $status = $request->status;
        return $this->userService->deleteUser($user_id, $status);
    }
}
