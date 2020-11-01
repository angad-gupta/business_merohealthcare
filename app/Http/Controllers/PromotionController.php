<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use Session;

class PromotionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Promotion::orderBy('id','desc')->get();
        return view('admin.promotions.index',compact('ads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotions.create');        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'link' => 'required|url',
            'photo' => 'required|mimes:jpeg,jpg,png,webp'
        ]);
        $ad = new Promotion();
        $data = $request->all();
        if ($file = $request->file('photo')) 
        {      
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);           
            $data['photo'] = $name;
        } 
        $ad->fill($data)->save();
        return redirect()->route('promotions.index')->with('success','New Promotion Added Successfully.');
    }


    public function edit($id)
    {
        $ad = Promotion::findOrFail($id);
        return view('admin.promotions.edit',compact('ad'));
    }

    public function status($id, $status)
    {
        $prod = Promotion::findOrFail($id);
        $prod->status = $status;
        $prod->update();
        Session::flash('success', 'Successfully Updated The Status.');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $ad = Promotion::findOrFail($id);
        $data = $request->all();

        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);
            if($ad->photo != null)
            {
                if (file_exists(public_path().'/assets/images/'.$ad->photo)) {
                    unlink(public_path().'/assets/images/'.$ad->photo);
                }
            }            
            $data['photo'] = $name;
        } 
        $ad->update($data);
        return redirect()->route('promotions.index')->with('success','Promotion Updated Successfully.');
    }


    public function destroy($id)
    {
        $ad = Promotion::findOrFail($id);

        if (file_exists(public_path().'/assets/images/'.$ad->photo)) {
            unlink(public_path().'/assets/images/'.$ad->photo);
        }

        $ad->delete();
        return redirect()->route('promotions.index')->with('success','Promotion Deleted Successfully.');
    }
}
