<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CareerDescription;
use App\CareerHiring;
use App\CareerOpening;
use App\CareerCandidate;

use Illuminate\Support\Facades\Session;

class CareerController extends Controller
{
    public function descriptions()
    {
   
        return view('admin.career.descriptions');
    }

    public function descriptionspost(Request $request, $id)
    {
        // dd($request);
        $d = CareerDescription::findOrFail($id);
        $d->title = $request->title;
        $d->description = $request->description;
        $d->points = $request->points;  
        $d->save();
        Session::flash('success', 'Career Descriptions Added Successfully.');
        return view('admin.career.descriptions')->with('success','Career Descriptions Added Successfully.');;
    }

    public function hiringspost(Request $request, $id)
    {
        // dd($request);
        $d = CareerHiring::findOrFail($id);
        $d->title = $request->title;
        $d->description = $request->description;
        $d->points = $request->points; 

        if ($file = $request->file('filename')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images',$name);
                if($d->image != null)
                {
                    if (file_exists(public_path().'/assets/images/'.$d->image)) {
                        unlink(public_path().'/assets/images/'.$d->image);
                    }
                }            
                $d->image = $name;
            }         

        $d->save();

        Session::flash('success', 'Career Hirings Descriptions Added Successfully.');
        return view('admin.career.descriptions')->with('success','Career Hirings Descriptions Added Successfully.');
    }


    public function openingsindex()
    {
        return view('admin.career.openingsindex');
    }

    public function openingscreate()
    {
        return view('admin.career.openingscreate');
    }

    public function openingscreatenew(Request $request)
    {
        $d = new CareerOpening;
        $d->title = $request->title;
        $d->description = $request->description;
    
        if ($file = $request->file('filename')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images',$name);
                if($d->image != null)
                {
                    if (file_exists(public_path().'/assets/images/'.$d->image)) {
                        unlink(public_path().'/assets/images/'.$d->image);
                    }
                }            
                $d->image = $name;
            }         

        $d->save();
        Session::flash('success', 'Career Openings Added Successfully.');

        return view('admin.career.openingsindex');
    }

    public function openingsedit($id)
    {
        $openings = CareerOpening::findOrFail($id);
        return view('admin.career.openingsedit',compact('openings'));
    }

    public function openingsdelete($id)
    {
        $openings = CareerOpening::findOrFail($id);

        $openings->delete();
        Session::flash('success', 'Career Deleted Added Successfully.');
        return view('admin.career.openingsindex',compact('openings'));
    }

    public function openingseditupdate(Request $request, $id)
    {
        $d = CareerOpening::findOrFail($id);
        $d->title = $request->title;
        $d->description = $request->description;
    
        if ($file = $request->file('filename')) 
            {              
                $name = time().$file->getClientOriginalName();
                $file->move('assets/images',$name);
                if($d->image != null)
                {
                    if (file_exists(public_path().'/assets/images/'.$d->image)) {
                        unlink(public_path().'/assets/images/'.$d->image);
                    }
                }            
                $d->image = $name;
            }         

        $d->save();

        Session::flash('success', 'Career Openings Added Successfully.');
        return view('admin.career.openingsindex')->with('success','Career Openings Added Successfully.');
    }

    public function candidates()
    {
        $candidates = CareerCandidate::orderBy('id','desc')->get();
        return view('admin.career.candidatesindex', compact('candidates'));
    }

    public function candidatesubmit(Request $request)
    {
        // dd($request);

        $this->validate($request, [
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
           
            'email' => 'required|string|max:191',
            // 'portfolio' => 'required|string|max:191',
            'phone' => 'required',
            'position' => 'required',
            'salary_requirements' => 'required',
            'last_company' => 'required',
           
            'cv' => 'required',
            'cv.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png,pdf',
           
           
        ]);

        $candidate = new CareerCandidate;
        $candidate->first_name = $request->first_name;
        $candidate->middle_name = $request->middle_name;
        $candidate->last_name = $request->last_name;

        $candidate->email = $request->email;
        $candidate->portfolio = $request->portfolio;
        $candidate->position = $request->position;
        $candidate->salary_requirements = $request->salary_requirements;
        $candidate->start = $request->start;
        $candidate->phone = $request->phone;
        $candidate->last_company = $request->last_company;
        $candidate->comments = $request->comments;

        
        if($request->hasFile('cv')){
            $reg_certificate_file = $request->file('cv');

            $filenameWithExt = $reg_certificate_file->getClientOriginalName();
            $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
            $path = $reg_certificate_file->storeAs('public/candidates', $filename);
            $candidate->cv = $filename;
        }

        $candidate->save();

        return view('front.candidatesuccess');
    }

    public function candidatesdetail($id)
    {
        $candidates = CareerCandidate::findOrFail($id);

        return view('admin.career.candidatesdetail', compact('candidates'));
    }

    public function candidatesdelete($id)
    {
        
        $candidates = CareerCandidate::findOrFail($id);

        $candidates->delete();
        Session::flash('success', 'Candidate Deleted Successfully.');
        return redirect()->route('admin-career-candidates');
    }

    public function candidatefile($id)
    {
      
        $c= CareerCandidate::findOrFail($id);
        
        try{
            $path = \Storage::get('public/candidates/'.$c->cv);
            $mimetype = \Storage::mimeType('public/candidates/'.$c->cv);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }



    
}
