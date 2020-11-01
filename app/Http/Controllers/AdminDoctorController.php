<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
// use Illuminate\Support\Facades\Session;
use App\Doctor;
use App\DoctorQuery;
use Session;

class AdminDoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $doctors = Doctor::orderBy('id','desc')->get();
        return view('admin.ask_doctor.index',compact('doctors'));
    }

    public function create(){
        return view('admin.ask_doctor.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'nmc' => 'required|integer',
            'post' => 'required',
            'description' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png,webp'
        ]);

        $doctor = new Doctor();
        $data = $request->all();
        if ($file = $request->file('photo')) 
        {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);           
            $data['photo'] = $name;
        }

        $doctor->fill($data)->save();
        return redirect()->route('admin-askdoctor-index')->with('success','New Doctor Added Successfully.');
    
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.ask_doctor.edit',compact('doctor'));
    }

    public function status($id, $status)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->status = $status;
        $doctor->update();
        Session::flash('success', 'Successfully Updated The Status.');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $data = $request->all();

        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);
            if($doctor->photo != null)
            {
                if (file_exists(public_path().'/assets/images/'.$doctor->photo)) {
                    unlink(public_path().'/assets/images/'.$doctor->photo);
                }
            }            
            $data['photo'] = $name;
        } 
        $doctor->update($data);
        return redirect()->route('admin-askdoctor-index')->with('success','Doctor Updated Successfully.');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);

        if (file_exists(public_path().'/assets/images/'.$doctor->photo)) {
            unlink(public_path().'/assets/images/'.$doctor->photo);
        }

        $doctor->delete();
        return redirect()->route('admin-askdoctor-index')->with('success','Doctor Deleted Successfully.');
    }

    public function queries(){
        $queries = DoctorQuery::all();
        return view('admin.ask_doctor.queries',compact('queries'));
    }
}
