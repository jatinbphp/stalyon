<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthorizationController extends Controller
{
    public function adminRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed|min:2',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 422);
        }

        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $input['token'] = "";

        if (!empty($input) || isset($input)) {
            Admin::create($input);
            $data['status'] = true;
            $data['message'] = "You Have Successfully Registered";
        } else {
            $data['status'] = false;
            $data['message'] = "Failed to register";
        }
        
        return response()->json($data);
    }

    public function adminLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|',
            'password' => 'required|',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 422);
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $admin = Auth::guard('admin')->user();
            $token = JWTAuth::fromUser($admin);
            Admin::where('id', $admin->id)->update(['token' => $token]);
            $data['status'] = true;
            $data['message'] = "Admin logged in successfully";
            $data['token'] = $token; 
        } else {
            $data['status']= false;
            $data['message']= "Invalid Credentials.Please Enter Correct Email and Password";
            return response()->json($data,401);
        }
        return response()->json($data);

    }

}
