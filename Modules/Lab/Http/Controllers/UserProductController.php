<?php

namespace Modules\Lab\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Lab\Entities\LabProduct as Test;
use Modules\Lab\Entities\LabProductUser as Product;
use App\Currency;
use Illuminate\Support\Facades\Session;
use Auth;

class UserProductController extends Controller
{
    
    public function index()
    {
        $user = Auth::guard('user')->user();
        $package = $user->subscribes()->orderBy('id','desc')->first();
        $prods = $user->labProducts()->orderBy('id','desc')->get();
        
        $sign = Currency::where('is_default','=',1)->first();
        return view('lab::user.product.index',compact('prods','cats','sign'));
    }

    public function create()
    {
        $user = Auth::guard('user')->user();
        
        $already = $user->labProducts()->pluck('product_id')->toArray();
        
        $tests = Test::where('status',1)->whereNotIn('id',$already)->get();
        $sign = Currency::where('is_default','=',1)->first();
        return view('lab::user.product.create',compact('tests','sign'));
    }

    public function status($id1,$id2)
    {
        $prod = Auth::guard('user')->user()->labProducts()->findOrFail($id1);
        $prod->status = $id2;
        $prod->update();
        Session::flash('success', 'Successfully Updated The Status.');
        return redirect()->route('user-lab-prod-index');
    }

    public function store(Request $request)
    {
        $user = Auth::guard('user')->user();
        // $package = $user->subscribes()->orderBy('id','desc')->first();
        // $prods = $user->labProducts()->orderBy('id','desc')->get()->count();
        
        // if($prods < $package->allowed_products)
        // {

            $this->validate($request, [
                'cprice' => 'required|numeric|min:1',
                'pprice' => 'nullable|numeric|min:1',
                'timing' => 'required|string',
                'report_delivery_time' => 'required|string',
                'product_id' => 'required|exists:lab_products,id'
            ],[
                'product_id.required' => 'Select a test.',
                'product_id.exists' => 'Invalid test'
            ]);

            $already = $user->labProducts()->pluck('product_id')->toArray();
        
            if(in_array($request->product_id,$already)){
                return redirect()->back()->with('unsuccess', 'Product has already been added.')->withInput();
            }

            $prod = new Product;
            $sign = Currency::where('is_default','=',1)->first();
            $input = $request->all();

            $input['user_id'] = $user->id;

            $input['cprice'] = ($input['cprice'] / $sign->value);
            if($input['pprice']) $input['pprice'] = ($input['pprice'] / $sign->value);      

            $prod->fill($input)->save();

            Session::flash('success', 'New Product added successfully.');
            return redirect()->route('user-lab-prod-index');            
        // }

        // else
        // {
        //     return redirect()->route('user-lab-prod-index')->with('unsuccess', 'You Can\'t Add More Test Product.');       
        // }

    }

    public function edit($id)
    {
        $user = Auth::guard('user')->user();
        $prod = $user->labProducts()->findOrFail($id);
        
        $already = $user->labProducts()->where('product_id','!=',$prod->product_id)->pluck('product_id')->toArray();
        
        $tests = Test::where('status',1)->whereNotIn('id',$already)->get();

        $sign = Currency::where('is_default','=',1)->first();
        
        return view('lab::user.product.edit',compact('tests','prod','sign'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::guard('user')->user();
        $prod = $user->labProducts()->findOrFail($id);
        $sign = Currency::where('is_default','=',1)->first();
        $input = $request->all();

        $this->validate($request, [
            'cprice' => 'required|numeric|min:1',
            'pprice' => 'nullable|numeric|min:1',
            'timing' => 'required|string',
            'report_delivery_time' => 'required|string',
            'product_id' => 'required|exists:lab_products,id'
        ],[
            'product_id.required' => 'Select a test.',
            'product_id.exists' => 'Invalid test'
        ]);

        $already = $user->labProducts()->where('product_id','!=',$prod->product_id)->pluck('product_id')->toArray();

        $prod = Product::findOrFail($id);

        if(in_array($request->product_id,$already)){
            return redirect()->back()->with('unsuccess', 'Product has already been added.')->withInput();
        }

        $sign = Currency::where('is_default','=',1)->first();
                 
        $input['cprice'] = $input['cprice'] / $sign->value;
        
        if($input['pprice']) $input['pprice'] = $input['pprice'] / $sign->value; 
        
        $prod->update($input);

        Session::flash('success', 'Product updated successfully.');
        return redirect()->route('user-lab-prod-index');
    }

    public function destroy($id)
    {
        $prod = Auth::guard('user')->user()->labProducts()->findOrFail($id);
        
        $prod->delete();
        Session::flash('success', 'Product deleted successfully.');
        return redirect()->route('user-lab-prod-index');
    }

}
