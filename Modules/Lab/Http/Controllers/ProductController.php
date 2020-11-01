<?php

namespace Modules\Lab\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Lab\Entities\LabProduct as Product;
use Modules\Lab\Entities\LabCategory as Category;
use Modules\Lab\Entities\LabCondition as Condition;
use Modules\Lab\Entities\LabSpeciality as Speciality;
use App\Currency;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $prods = Product::orderBy('id','desc')->get();
        $sign = Currency::where('is_default','=',1)->first();
        return view('lab::admin.product.index',compact('prods','cats','sign'));
    }

    public function deactive()
    {
        $prods = Product::where('status','=',0)->get();
        $sign = Currency::where('is_default','=',1)->first();
        return view('lab::admin.product.deactive',compact('prods','cats','sign'));
    }

    public function create()
    {
        $cats = Category::where('status',1)->get();
        $conds = Condition::where('status',1)->get();
        $specs = Speciality::where('status',1)->get();
        $sign = Currency::where('is_default','=',1)->first();
        $prods = Product::where('status','=',1)->orderBy('id','desc')->get();
        return view('lab::admin.product.create',compact('cats','sign','conds','specs','prods'));
    }

    public function status($id1,$id2)
    {
        $prod = Product::findOrFail($id1);
        $prod->status = $id2;
        $prod->update();
        Session::flash('success', 'Successfully Updated The Status.');
        return redirect()->back();
    }

    public function store(Request $request)
    {
    //    dd($request);
        $this->validate($request, [
            // 'pprice' => 'nullable|numeric|min:1',
            'photo' => 'nullable|mimes:jpeg,jpg,png',
            'name' => 'required',
            // 'highlights' => 'required',
            'category_ids' => 'required|min:1',
            'category_ids.*' => 'required|exists:lab_categories,id'
        ],[
            'category_ids.required' => 'Select atleast one category.',
            'category_ids.min' => 'Select atleast one category.',
            'category_ids.*.exists' => 'Invalid category'
        ]);

        $prod = new Product;
        $sign = Currency::where('is_default','=',1)->first();
        $input = $request->all();

        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);           
            $input['photo'] = $name;
        }
        
        if($request->has('products_ids')){
            foreach ($request->products_ids as $id){
                $data[] = $id;
            }  
            $prod->product_collection = json_encode($data);    
        }

        

        // $input['price'] = ($input['price'] / $sign->value);
        // if($input['pprice']) $input['pprice'] = ($input['pprice'] / $sign->value);             
        $prod->fill($input)->save();
        
        $prod->categories()->attach($request->category_ids);
        $prod->conditions()->attach($request->condition_ids);
        $prod->specialities()->attach($request->speciality_ids);

        Session::flash('success', 'New Product added successfully.');
        return redirect()->route('lab-prod-index');
    }

    public function edit($id)
    {
        $cats = Category::where('status',1)->get(); 
        $conds = Condition::where('status',1)->get();
        $specs = Speciality::where('status',1)->get();       
        $prod = Product::findOrFail($id);
        $prods = Product::where('status',1)->get(); 
        $sign = Currency::where('is_default','=',1)->first();
        
        return view('lab::admin.product.edit',compact('cats','prod','sign','conds','specs','prods'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'pprice' => 'nullable|numeric|min:1',
            // 'highlights' => 'required',
            'photo' => 'nullable|mimes:jpeg,jpg,png',
            'name' => 'required',
            'category_ids' => 'required|min:1',
            'category_ids.*' => 'required|exists:lab_categories,id'
        ],[
            'category_ids.required' => 'Select atleast one category.',
            'category_ids.min' => 'Select atleast one category.',
            'category_ids.*.exists' => 'Invalid category'
        ]);

        $prod = Product::findOrFail($id);
        $sign = Currency::where('is_default','=',1)->first();
        $input = $request->all();
        
        if ($file = $request->file('photo')) 
        {              
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);   
            if($prod->photo != null)
            {
                if (file_exists(public_path().'/assets/images/'.$prod->photo)) {
                    unlink(public_path().'/assets/images/'.$prod->photo);
                }
            }          
            $input['photo'] = $name;
        }       

        if($request->has('products_ids')){
            foreach ($request->products_ids as $id){
                $data[] = $id;
            }   
            $prod->product_collection = json_encode($data);   
        }

        
        
        $prod->update($input);

        $prod->categories()->sync($request->category_ids);
        $prod->conditions()->sync($request->condition_ids);
        $prod->specialities()->sync($request->speciality_ids);

        Session::flash('success', 'Product updated successfully.');
        return redirect()->route('lab-prod-index');
    }

    public function feature(Request $request, $id)
    {
        $prod = Product::findOrFail($id);
        $input = $request->all();
                 
        $prod->update($input);
        Session::flash('success', 'Product Highlight Updated Successfully.');
        return redirect()->route('lab-prod-index');
    }

    public function destroy($id)
    {
        $prod = Product::findOrFail($id);
        
        
        if ($prod->photo && file_exists(public_path().'/assets/images/'.$prod->photo)) {
            unlink(public_path().'/assets/images/'.$prod->photo);
        }
                
        $prod->delete();
        Session::flash('success', 'Product deleted successfully.');
        return redirect()->back();
    }
}
