<?php

namespace Modules\Lab\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Lab\Entities\LabCategory;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $cats = LabCategory::orderBy('id','desc')->get();
        return view('lab::admin.category.index',compact('cats'));
    }

    public function create()
    {
        return view('lab::admin.category.create');
    }

    public function status($id1,$id2)
    {
        $cat = LabCategory::findOrFail($id1);
        $cat->status = $id2;
        $cat->update();
        Session::flash('success', 'Successfully Updated The Status.');
        return redirect()->route('lab-cat-index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'priority_no' => 'nullable|integer',
            'cat_name' => 'required|string',
            'cat_slug' => 'required|string|unique:lab_categories',
            'photo' => 'mimes:jpeg,jpg,png',
        ]);

        $cat = new LabCategory;
        $input = $request->all();

        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);           
            $input['photo'] = $name;
        } 
        // if (!$request->priority_no) $input['priority_no'] = LabCategory::max('priority_no') + 1;

        $cat->fill($input)->save();
        Session::flash('success', 'New LabCategory added successfully.');
        return redirect()->route('lab-cat-index');
    }

    public function edit($id)
    {
        $cat = LabCategory::findOrFail($id);
        return view('lab::admin.category.edit',compact('cat'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'priority_no' => 'nullable|integer',
            'cat_name' => 'required|string',
            'cat_slug' => 'required|string|unique:lab_categories,cat_slug,'.$id,
            'photo' => 'mimes:jpeg,jpg,png',
        ]);

        $cat = LabCategory::findOrFail($id);
        $input = $request->all();
        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);
            if($cat->photo != null)
            {
                if (file_exists(public_path().'/assets/images/'.$cat->photo)) {
                    unlink(public_path().'/assets/images/'.$cat->photo);
                }
            }            
            $input['photo'] = $name;
        }
        // if (!$request->priority_no) $input['priority_no'] = $cat->priority_no;

        $cat->update($input);
        Session::flash('success', 'LabCategory updated successfully.');
        return redirect()->route('lab-cat-index');
    }

    public function destroy($id)
    {
        $cat = LabCategory::findOrFail($id);

        if( $cat->products()->count()>0 )
        {
            Session::flash('unsuccess', 'Remove the products first !!!!');
            return redirect()->route('lab-cat-index');
        }

        if($cat->photo == null){
            $cat->delete();
            Session::flash('success', 'LabCategory deleted successfully.');
            return redirect()->route('lab-cat-index');
        }
        
        if (file_exists(public_path().'/assets/images/'.$cat->photo)) {
            unlink(public_path().'/assets/images/'.$cat->photo);
        }

        $cat->delete();
        Session::flash('success', 'LabCategory deleted successfully.');
        return redirect()->route('lab-cat-index');
    }
}
