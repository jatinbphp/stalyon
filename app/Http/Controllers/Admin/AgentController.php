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
        $agent_id= $request->id;
        $agent=Agent::where('id', $agent_id)->first();
        if(empty($agent) && !isset($agent))
        {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:agents,email',
                'country_code' => 'required',
                'password'=>'required|confirmed|min:5',
                'phone'=>'required|numeric',
                'status' => 'required|',
                'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->all()], 422);
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
        }
        else{
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|unique:agents,email,' . $agent_id . ',id',
                'country_code' => 'required',
                'phone'=>'required|numeric',
                'status' => 'required|',
                'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => false, 'message' => $validator->errors()->all()], 422);
            }
            $input=$request->all();
            $input['password']= \Hash::make($request->password);
            if ($request->hasFile('image')) {
               $image = $request->file('image');
               $imageName = time().'.'.$image->getClientOriginalExtension();
               $image->move(public_path('images/agents'), $imageName);
               $input['image'] = 'images/agents/'.$imageName; 
           }
           else {
            $input['image'] = null; 
        }
           if (!empty($input) || isset($input)) {
            Agent::where('id',$agent_id)->update($input);
            $data['status'] = true;
            $data['message'] = "Agent updated successfully";
            } else {
                $data['status'] = false;
                $data['message'] = "Failed to update agent";
            }
        }
        
        return response()->json($data);
    }

    public function agentList(Request $request)
    {
       $agent_list = Agent::select('*')->get()->makeHidden(['password','deleted_at', 'created_at','updated_at']);
       if(!empty($agent_list) && isset($agent_list))
       {
         $data['data']= $agent_list;
         $data['status']= true;
         $data['message']= "Agent list gets successfully";
       }
       else
       {
        $data['status']= false;
        $data['message']= "Unable to get agent list";
       }
       return response()->json($data);
    }

    public function removeAgent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agent_id' => 'required|exists:agents,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->all()], 422);
        }
        $agent_id=Agent::where('id',$request->agent_id)->first();
        if(($agent_id))
        {
            Agent::where('id',$request->agent_id)->delete();
            $data['status']= true;
            $data['message']="Agent deleted successfully";
        }
        else{
            $data['status']= false;
            $data['message']="Invalid agent id";
        }
        return response()->json($data);
    }
}
