<?php

namespace Modules\Lab\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Lab\Entities\LabCategoryProduct;
use Modules\Lab\Entities\LabConditionProduct;
use Modules\Lab\Entities\LabSpecialityProduct;
use Modules\Lab\Entities\LabCategory as Category;
use Modules\Lab\Entities\LabProduct as Product;
use Modules\Lab\Entities\LabCondition as Condition;
use Modules\Lab\Entities\LabSpeciality as Speciality;
use Modules\Lab\Entities\LabProductUser as VendorProduct;
use Modules\Lab\Entities\LabCart as Cart;
use App\Compare;

use Session;
use Auth;
use App\Currency;
use Modules\Lab\Entities\LabOrder;
use Modules\Lab\Entities\LabOrderItem;
use App\User;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $cats = Product::where('status',1)->orderBy('id')->get();
        $labcategories=Category::where('status',1)->orderBy('id')->get();
        $labconditions=Condition::where('status',1)->orderBy('condition_name')->get();
        $labspecialities=Speciality::where('status',1)->orderBy('speciality_name')->get();
        $cat_packages = Product::where('status',1)->where('type','Package')->orderBy('id')->get();
        $packages = collect();
        foreach($cat_packages as $cat){
            $packages = $packages->merge($cat->options()->where('status',1)->get());
        }
       
        return response()->json(['cats'=>$cats,
                                 'labcategories'=>$labcategories,
                                 'labconditions'=>$labconditions,
                                 'labspecialities'=>$labspecialities,
                                 'packages'=>$packages],200);
    }

    public function category($slug)
    {

        
        $category=Category::where('cat_slug',$slug)->get();
        $cat=Category::where('cat_slug',$slug)->pluck('cat_name')->toArray();
        
        $labcategories=Category::where('status',1)->orderBy('id')->get();
        
        if($category->count()==0)
        {
            $cats = Product::where('status',1)->orderBy('id')->get();
        }
        else{
            $lab_category_product_ids=LabCategoryProduct::where('lab_category_id',$category->first()->id)->pluck('lab_product_id')->toArray();

            $cats=Product::where('status',1)->whereIn('id',$lab_category_product_ids)->get();
        }
        return response()->json(['cats'=>$cats,
                                'labcategories'=>$labcategories,
                                'cat'=>$cat],200);

    }
    public function condition($slug)
    {
        $condition=Condition::where('condition_slug',$slug)->get();
        $cond=Condition::where('condition_slug',$slug)->pluck('condition_name')->toArray();
    
        $labconditions=Condition::where('status',1)->orderBy('id')->get();
        
        if($condition->count()==0)
        {
            $conds = Product::where('status',1)->orderBy('id')->get();
        }
        else{
            $lab_condition_product_ids=LabConditionProduct::where('lab_condition_id',$condition->first()->id)->pluck('lab_product_id')->toArray();

            $conds=Product::where('status',1)->whereIn('id',$lab_condition_product_ids)->get();
        }
        return response()->json(['conds'=>$conds,
                                'labconditions'=>$labconditions,
                                'cond'=>$cond],200);

    }

    public function speciality($slug)
    {
        // dd($slug);

        $speciality=Speciality::where('speciality_slug',$slug)->get();
        $spec=Speciality::where('speciality_slug',$slug)->pluck('speciality_name')->toArray();
        // dd($cat);
        $labspecialities = Speciality::where('status',1)->orderBy('id')->get();
        
        if($speciality->count()==0)
        {
            $specs = Product::where('status',1)->orderBy('id')->get();
        }
        else{
            $lab_speciality_product_ids=LabSpecialityProduct::where('lab_speciality_id',$speciality->first()->id)->pluck('lab_product_id')->toArray();

            $specs=Product::where('status',1)->whereIn('id',$lab_speciality_product_ids)->get();
        }

        return response()->json(['specs'=>$specs,
                                'labspecialities'=>$labspecialities,
                                'spec'=>$spec],200);

    }

    public function alphabet($slug)
    {
        $alphabetslug = $slug;
        $alphabet = Product::where('status',1)->where('name','LIKE',$slug.'%')->orderBy('id')->get();
        return response()->json(['alphabet'=>$alphabet,
                                'alphabetslug'=>$alphabetslug],200);
      
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function cart(Request $request)
    {
        $cart = $request->cart;
        if(!$cart){
            $data['success'] = false;
            $data['message'] = 'Cart cannot be empty.';
            return response()->json($data,500);
        }
      
        $tests = VendorProduct::where('user_id',$cart->vendor_id)->where('status',1)->get();
        
        $products=array();
        foreach ($tests as $p) {
            $product = (object)null;
            $product->text = $p->type->name;
            $product->id = $p->id;
            $product->disabled = $cart->exists($p->id);
            $products []= $product;
        }
        return response()->json(['cart_items' => $cart->items, 'totalPrice' => $cart->totalPrice, 'tests' => json_encode($products)],200); 
    }

    public function checkout(Request $request)
    {
        if(Auth::user()->is_vendor != 0) {
            $data['success'] = false;
            $data['message'] = 'You cannot use vendor account to book lab tests. You must have a normal user account.';
            return response()->json($data,500);
        }

        $cart = $request->cart;
        
        if(!$cart){
            $data['success'] = false;
            $data['message'] = 'Cart cannot be empty.';
            return response()->json($data,500);
        }

      
        $tests = VendorProduct::where('user_id',$cart->vendor_id)->where('status',1)->get();
        
        $products=array();
        foreach ($tests as $p) {
            $product = (object)null;
            $product->text = $p->type->name;
            $product->id = $p->id;
            $product->disabled = $cart->exists($p->id);
            $products []= $product;
        }
        return response()->json(['cart_items' => $cart->items,
                                 'totalPrice' => $cart->totalPrice, 
                                 'tests' => json_encode($products)],200);
                                 
    }

    // public function addFamily(Request $request)
    // {
    //     $this->validate($request, [
    //         'firstname' => 'required|string|max:191',
    //         'relation' => 'required',
    //         'age' => 'required|integer|min:1',
    //         'gender' => 'required|in:Male,Female,Other'
    //     ]);
        
        
    //     $name = $request->firstname.' '.$request->middlename.' '.$request->lastname;
    //     // dd($name);
    //     $user = Auth::guard('user')->user();
    //     $family = new Family();
    //     $family->name = $name;
    //     $family->age = $request->age;
    //     $family->gender = $request->gender;
    //     $family->relation = $request->relation;
    //     $family->user_id = $user->id;
    //     $family->save();

    //     return redirect()->route('lab.checkout')->with('success','Family Information added Successfully');
    // }


    public function confirm(Request $request)
    {
        $user = Auth::user();
        
        $this->validate($request,[
            'name' => 'required|string',
            'age' => 'required|integer|min:1',
            'gender' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required|string',
        ]);
        
      
        
        $curr = Currency::where('is_default','=',1)->first();
        
        $lab_cart=$request->cart;

        $vendor = User::where('is_vendor',2)->find($lab_cart->vendor_id);
        if(!$vendor){
            $data['success'] = false;
            $data['message'] = 'Invalid Vendor';
            return response()->json($data,500);
        }

        $lab_order=new LabOrder;
        $lab_order->vendor_id=$lab_cart->vendor_id;
        $lab_order->totalQty=$lab_cart->totalQty;
        $lab_order->pay_amount=$lab_cart->totalPrice;
        $lab_order->order_number = str_random(4).time();

        $lab_order->user_id=$user->id;
     
        $lab_order->customer_name=$user->name;
        $lab_order->customer_email=$user->email;
        $lab_order->customer_phone=$request->phone;
        $lab_order->customer_address=$request->address;
        $lab_order->latlong = $request->latlong;
        
        $lab_order->customer_details=json_encode(["name"=>$request->name, "age"=>$request->age, "gender"=>$request->gender,"service_address"=>$request->address]);
        $lab_order->timing=$request->timing;

        $lab_order->currency_sign=$curr->sign;
        $lab_order->currency_value=$curr->value;    
        $lab_order->status="pending";

        $lab_order->save();

        foreach($lab_cart->items as $item)
        {
            // dd($item);
            $lab_order_item= new LabOrderItem;
            $lab_order_item->lab_order_id=$lab_order->id;
            $lab_order_item->test_id=$item['item']->id;
            $lab_order_item->test_name=$item['item']->name;
            $lab_order_item->test_price=$item['item']->price;
            $lab_order_item->save();

        }
        
        return response()->json(["order"=>$lab_order],200);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('lab::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('lab::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
