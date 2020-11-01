<?php

namespace Modules\Lab\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Lab\Entities\LabCondition;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LabConditionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $conds = LabCondition::orderBy('id','desc')->get();
        $condssearch = [];
        return view('lab::admin.condition.index',compact('conds','condssearch'));
    }

   
    public function create()
    {
        return view('lab::admin.condition.create');
    }

   
    public function store(Request $request)
    {
        // dd($request);
        // $this->validate($request, [
        //     'condition_name' => 'required|string',
        //     'condition_slug' => 'required|string|unique:lab_conditions',
        //     'photo' => 'mimes:jpeg,jpg,png',
        // ]);

        $cat = new LabCondition;
        $input = $request->all();

        // dd($cat);

        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);           
            $input['photo'] = $name;
        } 
        // if (!$request->priority_no) $input['priority_no'] = LabCategory::max('priority_no') + 1;

        $cat->fill($input)->save();
        Session::flash('success', 'New LabCondition added successfully.');
        return redirect()->route('lab-condition-index');
    }

   
    public function status($id1,$id2)
    {
        $con = LabCondition::findOrFail($id1);
        $con->status = $id2;
        $con->update();
        Session::flash('success', 'Successfully Updated The Status.');
        return redirect()->route('lab-condition-index');
    }

 
    public function edit($id)
    {
        $con = LabCondition::findOrFail($id);
        return view('lab::admin.condition.edit',compact('con'));
    }

  
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     // 'priority_no' => 'nullable|integer',
        //     'condition_name' => 'required|string',
        //     'condition_slug' => 'required|string|unique:lab_conditions,condition_slug,'.$id,
        //     'photo' => 'mimes:jpeg,jpg,png',
        // ]);

        $con = LabCondition::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);
            if($con->photo != null)
            {
                if (file_exists(public_path().'/assets/images/'.$con->photo)) {
                    unlink(public_path().'/assets/images/'.$con->photo);
                }
            }            
            $input['photo'] = $name;
        }
        // if (!$request->priority_no) $input['priority_no'] = $cat->priority_no;

        $con->update($input);
        Session::flash('success', 'Lab Condition updated successfully.');
        return redirect()->route('lab-condition-index');
    }

   
    public function destroy($id)
    {
        $con = LabCondition::findOrFail($id);

        if( $con->products()->count()>0 )
        {
            Session::flash('unsuccess', 'Remove the products first !!!!');
            return redirect()->route('lab-condition-index');
        }

        if($con->photo == null){
            $con->delete();
            Session::flash('success', 'Lab Condition deleted successfully.');
            return redirect()->route('lab-condition-index');
        }
        
        if (file_exists(public_path().'/assets/images/'.$con->photo)) {
            unlink(public_path().'/assets/images/'.$con->photo);
        }

        $con->delete();
        Session::flash('success', 'Lab Condition deleted successfully.');
        return redirect()->route('lab-condition-index');
    }
}
