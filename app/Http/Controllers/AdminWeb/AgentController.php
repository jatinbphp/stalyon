<?php

namespace App\Http\Controllers\AdminWeb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Agent;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['menu']= "Agents";
        if ($request->ajax()) {
            $agent = Agent::all();
            return Datatables::of($agent)
                ->addIndexColumn()
                ->editColumn('created_at', function($row){
                    return $row['created_at']->format('Y-m-d h:i:s');
                })
                ->editColumn('status', function($row){
                    $row['table_name'] = 'agents';
                    return view('admin.common.status-buttons', $row);
                })
                ->addColumn('action', function($row){
                    $row['section_name'] = 'agents';
                    $row['section_title'] = 'Agents';
                    return view('admin.common.action-buttons', $row);
                })
                ->make(true);
        }
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['menu'] = 'Agents';
        return view("admin.user.create",$data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'full_name'=>'required',
        'email'=>'required|email|unique:agents',
        'password'=>'required|confirmed|min:3',
        'country_code'=>'required',
        'phone'=>'required',
        'image'=> 'image|mimes:jpeg,jpg,png,gif',
        'status'=> 'required',
        ]);
        $input = $request->all();
        $input['password']= \Hash::make($request->password);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/agents'), $imageName);
            $input['image'] = 'images/agents/'.$imageName;
        }
        if(isset($input))
        {
            Agent::create($input);
            \Session::flash('success', 'Agent registered successfully!');
        }
        return redirect()->route('agents.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['menu'] = 'Agents';
        $data['agents'] = Agent::where('id',$id)->first();
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(empty($request['password'])){
            unset($request['password']);
        }

        $input = $request->all();
        $input['password']= \Hash::make($request->password);

        $agent = Agent::findorFail($id);

        if($file = $request->file('image')){
            if (!empty($agent['image'])) {
                @unlink($agent['image']);
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images/agents'), $imageName);
            $input['image'] = 'images/agents/'.$imageName;
        }
        $agent->update($input);

        \Session::flash('success','Agent has been updated successfully!');
        return redirect()->route('agents.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
