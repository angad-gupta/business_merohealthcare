<?php

namespace Modules\Lab\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Lab\Entities\LabSpeciality;
use Illuminate\Support\Facades\Session;

class LabSpecialityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $specs = LabSpeciality::orderBy('id','desc')->get();
        return view('lab::admin.speciality.index',compact('specs'));
    }

   
    public function create()
    {
        return view('lab::admin.speciality.create');
    }

   
    public function store(Request $request)
    {
        // dd($request);
        // $this->validate($request, [
        //     'condition_name' => 'required|string',
        //     'condition_slug' => 'required|string|unique:lab_conditions',
        //     'photo' => 'mimes:jpeg,jpg,png',
        // ]);

        $spec = new LabSpeciality;
        $input = $request->all();

        // dd($cat);

        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);           
            $input['photo'] = $name;
        } 
        // if (!$request->priority_no) $input['priority_no'] = LabCategory::max('priority_no') + 1;

        $spec->fill($input)->save();
        Session::flash('success', 'New LabSpeciality added successfully.');
        return redirect()->route('lab-speciality-index');
    }

   
    public function status($id1,$id2)
    {
        $spec = LabSpeciality::findOrFail($id1);
        $spec->status = $id2;
        $spec->update();
        Session::flash('success', 'Successfully Updated The Status.');
        return redirect()->route('lab-speciality-index');
    }

 
    public function edit($id)
    {
        $spec = LabSpeciality::findOrFail($id);
        return view('lab::admin.speciality.edit',compact('spec'));
    }

  
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     // 'priority_no' => 'nullable|integer',
        //     'condition_name' => 'required|string',
        //     'condition_slug' => 'required|string|unique:lab_conditions,condition_slug,'.$id,
        //     'photo' => 'mimes:jpeg,jpg,png',
        // ]);

        $spec = LabSpeciality::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);
            if($spec->photo != null)
            {
                if (file_exists(public_path().'/assets/images/'.$spec->photo)) {
                    unlink(public_path().'/assets/images/'.$spec->photo);
                }
            }            
            $input['photo'] = $name;
        }
        // if (!$request->priority_no) $input['priority_no'] = $cat->priority_no;

        $spec->update($input);
        Session::flash('success', 'Lab Speciality updated successfully.');
        return redirect()->route('lab-speciality-index');
    }

   
    public function destroy($id)
    {
        $spec = LabSpeciality::findOrFail($id);

        if( $spec->products()->count()>0 )
        {
            Session::flash('unsuccess', 'Remove the products first !!!!');
            return redirect()->route('lab-speciality-index');
        }

        if($spec->photo == null){
            $spec->delete();
            Session::flash('success', 'Lab Speciality deleted successfully.');
            return redirect()->route('lab-speciality-index');
        }
        
        if (file_exists(public_path().'/assets/images/'.$spec->photo)) {
            unlink(public_path().'/assets/images/'.$spec->photo);
        }

        $spec->delete();
        Session::flash('success', 'Lab Speciality deleted successfully.');
        return redirect()->route('lab-speciality-index');
    }
}
