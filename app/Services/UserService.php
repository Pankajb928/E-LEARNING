<?php

namespace App\Services;

use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\JWTService;

class UserService
{
    protected $jwtService;

    public function __construct(JWTService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function createUser(array $data): JsonResponse
    {
        $query = UserDetail::query();
        if (!empty($data['user_id'])) {
            $query->where('user_id', $data['user_id']);
        }
        if (!empty($data['email'])) {
            // If user_id was provided, use orWhere, otherwise just use where
            $method = !empty($data['user_id']) ? 'orWhere' : 'where';
            $query->{$method}('email', $data['email']);
        }
        $userDetail = $query->first();
        if ($userDetail) {
            return response()->json([
                'User' => $userDetail,
                'message' => 'User already Exist',
                'Status' => true
            ], 201);
        }
        $validationResult = $this->validateData($data);
        // If validation fails, return a JSON response with errors
        if ($validationResult->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validationResult->errors(),
                'Status' => false
            ], 422); 
        }
        
        // Create a new user detail instance
        $userDetails = new UserDetail();
        $userDetails->user_id = $data['user_id'];
        $userDetails->name = $data['name'];
        $userDetails->email = $data['email'];
        $userDetails->address = $data['address'];
        $userDetails->mobile_no = $data['mobile_no'];
        $userDetails->password = Hash::make(env('DEFAULT_PASS'));
        $userDetails->save();
        
        // Return a JSON response
        return response()->json([
            'User' => $userDetails,
            'message' => 'User created successfully',
            'Status' => true
        ], 201);
    }
    
    public function validateData(array $data)
    {
        // Create the validator instance
        return Validator::make($data, [
            'user_id' =>'required|unique:user_details',
            'name' => 'required',
            'email' => 'required|email|unique:user_details',
            'address' => 'required',
            'mobile_no' => 'required|unique:user_details',
        ], [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email address must be a valid email format.',
            'email.unique' => 'The email address is already in use.',
            'address.required' => 'The address field is required.',
            'mobile_no.required' => 'The mobile number field is required.',
            'mobile_no.unique' => 'The mobile number is already in use.',
        ]);
    }

    public function updateUser(array $data)
    {
        $this->updateValidateData($data);

        // Find the user by Email
        $userDetail = UserDetail::where('user_id', $data['user_id'])->first();
        if (!$userDetail) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Loop through the data and update only the provided fields
        foreach ($data as $key => $value) {
            if (in_array($key, ['name', 'email', 'address', 'mobile_no'])) {
                $userDetail->$key = $value;
            }
        }

        $userDetail->save();

        return response()->json(['User' => $userDetail, 'message' => 'User updated successfully', 'status' => true], 200);
    }

    protected function updateValidateData(array $data)
    {
        return Validator::make($data, [
            'user_id' => 'required|exists:user_details,user_id', // Ensure user_id exists
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email',
            'address' => 'sometimes|required',
            'mobile_no' => 'sometimes|required'
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
            // dd($userDetail);
            $token = $this->jwtService->tokenEncode([
                'id' => $userDetail->id,
                'email' => $userDetail->email,
            ]);
            $userDetail->token = $token;
            $userDetail->save();
            // $token =  $this->jwtService->tokenEncode($userDetail);
            return response()->json(['token' => $token , 'message' => 'Login Successful' , 'status' =>200], 200);
        }
        else{
            return response()->json(['user' => [] ,'message' => 'Password is Incorrect Please Check Password!' , 'status' =>401 ], 401 );
        }
    }

    public function resetPassword(string $email){
        $userDetail = UserDetail::where('email', $email)->first();
        if ($userDetail) {
            $userDetail->password = Hash::make(env('DEFAULT_PASS'));
            $userDetail->save();
            return response()->json(['message' => 'Password changed successfully', 'status' => true], 200);
        } else {
            return response()->json(['message' => 'User Details not found', 'status' => false], 200);
        }
    }

    public function listUser()
    {
        $userDetails = UserDetail::select('user_id', 'name', 'email', 'mobile_no', 'address')
        ->orderBy('id', 'desc') // Apply order before executing the query
        ->get(); 
        if (!$userDetails) {
            return response()->json(['message' => 'No user Found'], 200);
        }
    
        return response()->json(['User' => $userDetails, 'message' => 'User details fetched successfully', 'status' => true], 200);
    }
    
    
}
