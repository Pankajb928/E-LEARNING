<?php

namespace App\Services;

use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function createUser(array $data)
    {
        $this->validateData($data);

        $userDetails = new UserDetail();
        $userDetails->name = $data['name'];
        $userDetails->email = $data['email'];
        $userDetails->address = $data['address'];
        $userDetails->mobile_no = $data['mobile_no'];
        $userDetails->password = Hash::make($data['password']);
        $userDetails->save();

        return response()->json(['User'=>[$userDetails] , 'message' => 'User created successfully' , 'Status' => true], 201);
    }

    public function validateData(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email|unique:user_details', // Changed 'users' to 'user_details'
            'address' => 'required',
            'mobile_no' => 'required|unique:user_details', // Changed 'users' to 'user_details'
            'password' => 'required|min:6',
        ])->validate();
    }

    public function updateUser(array $data, string $email)
    {
        $this->updateValidateData($data);

        // Find the user by Email
        $userDetail = UserDetail::where('email', $email)->first();
        if (!$userDetail) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user details
        $userDetail->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'mobile_no' => $data['mobile_no'],
        ])->save();

        return response()->json(['User' => $data , 'message' => 'User updated successfully', 'status' => true], 200);
    }

    protected function updateValidateData(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'mobile_no' => 'required'
        ])->validate();
    }


        public function login(string $email, string $password)
        {
            $userDetail = array();
            $userDetail = UserDetail::where('email', $email)->first();
            if (!$userDetail) {
                return response()->json(['user' => $userDetail ? $userDetail : [] ,'message' => 'User not found Please check Email or connect with Admin' , 'status' =>404 ], 404 );
            }
            if (Hash::check($password, $userDetail->password)) {
                return response()->json(['user' => $userDetail ,'message' => 'Login Successful' , 'status' =>200], 200);
            }
            else{
                return response()->json(['user' => [] ,'message' => 'Password is Incorrect Please Check Password!' , 'status' =>401 ], 401 );
            }
        }

        public function resetPassword(string $email){
            $userDetail = UserDetail::where('email', $email)->first();
            if ($userDetail) {
                $userDetail->password = Hash::make('Admin@123');
                $userDetail->save();
                return response()->json(['message' => 'Password changed successfully', 'status' => true], 200);
            } else {
                return response()->json(['message' => 'User Details not found', 'status' => false], 200);
            }
        }
        
    
}
