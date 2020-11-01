<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $cats = Category::orderBy('id','desc')->get();
        return view('admin.category.index',compact('cats'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function status($id1,$id2)
    {
        $cat = Category::findOrFail($id1);
        $cat->status = $id2;
        $cat->update();
        Session::flash('success', 'Successfully Updated The Status.');
        return redirect()->route('admin-cat-index');
    }

    public function store(StoreValidationRequest $request)
    {
        $this->validate($request, [
            'priority_no' => 'nullable|integer',
        ]);
        $cat = new Category;
        $input = $request->all();
        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);           
            $input['photo'] = $name;
        } 
        if (!$request->priority_no) $input['priority_no'] = Category::max('priority_no') + 1;

        $cat->fill($input)->save();
        Session::flash('success', 'New Category added successfully.');
        return redirect()->route('admin-cat-index');
    }

    public function edit($id)
    {
        $cat = Category::findOrFail($id);
        return view('admin.category.edit',compact('cat'));
    }

    public function update(UpdateValidationRequest $request, $id)
    {
        $this->validate($request, [
            'priority_no' => 'nullable|integer',
        ]);

        $cat = Category::findOrFail($id);
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
        if (!$request->priority_no) $input['priority_no'] = $cat->priority_no;

        $cat->update($input);
        Session::flash('success', 'Category updated successfully.');
        return redirect()->route('admin-cat-index');
    }

    public function destroy($id)
    {
        $cat = Category::findOrFail($id);
        if($cat->subs->count()>0)
        {
            Session::flash('unsuccess', 'Remove the subcategories first !!!!');
            return redirect()->route('admin-cat-index');
        }
        if($cat->products->count()>0)
        {
            Session::flash('unsuccess', 'Remove the products first !!!!');
            return redirect()->route('admin-cat-index');
        }
        if($cat->photo == null){
         $cat->delete();
        Session::flash('success', 'Category deleted successfully.');
        return redirect()->route('admin-cat-index');
        }
                    if (file_exists(public_path().'/assets/images/'.$cat->photo)) {
                        unlink(public_path().'/assets/images/'.$cat->photo);
                    }
        $cat->delete();
        Session::flash('success', 'Category deleted successfully.');
        return redirect()->route('admin-cat-index');
    }
}
