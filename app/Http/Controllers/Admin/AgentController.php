<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Agent;

class AgentController extends Controller
{
    public function addAgent (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'country_code' => 'required',
            'password'=>'required|confirmed|',
            'phone'=>'required|numeric',
            'status' => 'required|',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 422);
        }
         $input=$request->all();
         $input['password']= \Hash::make($request->password);
         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/agents'), $imageName);
            $input['image'] = 'images/agents/'.$imageName; 
        }
         if (!empty($input) || isset($input)) {
            Agent::create($input);
            $data['status'] = true;
            $data['message'] = "Agent created successfully";
        } else {
            $data['status'] = false;
            $data['message'] = "Failed to create agent";
        }
        return response()->json($data);
    }
}
