<?php

namespace Modules\Lab\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Lab\Entities\LabCategoryProduct;
use Modules\Lab\Entities\LabConditionProduct;
use Modules\Lab\Entities\LabSpecialityProduct;
use Modules\Lab\Entities\LabCategory as Category;
use Modules\Lab\Entities\LabCondition as Condition;
use Modules\Lab\Entities\LabSpeciality as Speciality;
use Modules\Lab\Entities\LabProduct as Product;
use Modules\Lab\Entities\LabProductUser as VendorProduct;
use Modules\Lab\Entities\LabCart as Cart;
use App\Compare;
use App\Family;
use Session;
use Auth;
use App\Currency;
use Modules\Lab\Entities\LabOrder;
use Modules\Lab\Entities\LabOrderItem;
use App\User;
use App\GeneralSetting;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // dd('asdfsdf');
        $cats = Product::where('status',1)->orderBy('id')->get();
        $labcategories=Category::where('status',1)->orderBy('cat_name')->get();
        $labconditions=Condition::where('status',1)->orderBy('condition_name')->get();
        $labspecialities=Speciality::where('status',1)->orderBy('speciality_name')->get();
        $cat_packages = Product::where('status',1)->where('type','Package')->orderBy('id')->get();
        $packages = collect();
        $tests = Product::where('status',1)->orderBy('id')->get();
        foreach($cat_packages as $cat){
            $packages = $packages->merge($cat->options()->where('status',1)->get());
        }
       
        return view('lab::front.index',compact('cats','labcategories','packages','tests','labconditions','labspecialities'));
    }

    public function category($slug)
    {

        $category=Category::where('cat_slug',$slug)->get();
        $cat=Category::where('cat_slug',$slug)->pluck('cat_name')->toArray();
        // dd($cat);
        $labcategories=Category::where('status',1)->orderBy('id')->get();
        
        if($category->count()==0)
        {
            $cats = Product::where('status',1)->orderBy('id')->get();
        }
        else{
            $lab_category_product_ids=LabCategoryProduct::where('lab_category_id',$category->first()->id)->pluck('lab_product_id')->toArray();

            $cats=Product::where('status',1)->whereIn('id',$lab_category_product_ids)->get();
        }
        return view('lab::front.labtests',compact('cats','labcategories','cat'));

    }

    public function condition($slug)
    {
        // dd($slug);

        $condition=Condition::where('condition_slug',$slug)->get();
        $cond=Condition::where('condition_slug',$slug)->pluck('condition_name')->toArray();
        // dd($cat);
        $labconditions=Condition::where('status',1)->orderBy('id')->get();
        
        if($condition->count()==0)
        {
            $conds = Product::where('status',1)->orderBy('id')->get();
        }
        else{
            $lab_condition_product_ids=LabConditionProduct::where('lab_condition_id',$condition->first()->id)->pluck('lab_product_id')->toArray();

            $conds=Product::where('status',1)->whereIn('id',$lab_condition_product_ids)->get();
        }
        return view('lab::front.labconditiontests',compact('conds','labconditions','cond'));

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
        return view('lab::front.labspecialitytests',compact('specs','labspecialities','spec'));

    }

    public function alphabet($slug)
    {
        // dd($slug);
        $alphabetslug = $slug;
        $alphabet = Product::where('status',1)->where('name','LIKE',$slug.'%')->orderBy('id')->get();
        // dd($alphabet);
      
        return view('lab::front.labalphabettests',compact('alphabet','alphabetslug'));

    }


    public function search(Request $request)
    {
        // dd($request);
        $cats = Product::where('status',1)->where('name','LIKE','%'.$request->searchkey.'%')->orderBy('id')->get();
        // dd($cats);
        return view('lab::front.labtests',compact('cats','labcategories'));

    }
    public function compare()
    {
        $tests = Product::where('status',1)->orderBy('id')->get();
        
        return view('lab::front.compare',compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function cart()
    {
        $oldCart = Session::get('lab_cart');

        if(!$oldCart){
            Session::flash('unsuccess', 'Cart is empty.');
            return redirect()->route('lab.index');
        }

        $cart = new Cart($oldCart);
      
        $tests = VendorProduct::where('user_id',$cart->vendor_id)->where('status',1)->get();
        
        $products=array();
        foreach ($tests as $p) {
            $product = (object)null;
            $product->text = $p->type->name;
            $product->id = $p->id;
            $product->disabled = $cart->exists($p->id);
            $products []= $product;
        }
        $gs = GeneralSetting::findOrFail(1);
        $health_tax_amount = $cart->totalPrice - ($cart->totalPrice/(1+($gs->lab_vat/100)));
        return view('lab::front.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'tests' => json_encode($products), 'health_tax_amount' => $health_tax_amount]); 
    }

    public function checkout()
    {
        if(Auth::guard('user')->user()->is_vendor != 0) {
            Session::flash('unsuccess','You cannot use vendor account to book lab tests. You must have a normal user account.');
            return redirect()->route('lab.cart');
        }

        $oldCart = Session::get('lab_cart');
        
        if(!$oldCart){
            Session::flash('unsuccess', 'Cart is empty.');
            return redirect()->route('lab.index');
        }

        $cart = new Cart($oldCart);
      
        $tests = VendorProduct::where('user_id',$cart->vendor_id)->where('status',1)->get();
        
        $products=array();
        foreach ($tests as $p) {
            $product = (object)null;
            $product->text = $p->type->name;
            $product->id = $p->id;
            $product->disabled = $cart->exists($p->id);
            $products []= $product;
        }
        $gs = GeneralSetting::findOrFail(1);
        $health_tax_amount = $cart->totalPrice - ($cart->totalPrice/(1+($gs->lab_vat/100)));
        return view('lab::front.checkout', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'tests' => json_encode($products),'health_tax_amount' => $health_tax_amount]);
    }

    public function addFamily(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:191',
            'relation' => 'required',
            // 'age' => 'required|integer|min:1',
            'dob' => 'required',
            'gender' => 'required|in:Male,Female,Other'
        ]);
        
        
        $name = $request->firstname.' '.$request->middlename.' '.$request->lastname;
        // dd($name);
        $user = Auth::guard('user')->user();
        // $family = new Family();
        // $family->name = $name;
        // $family->dob = $request->dob;
        // $family->gender = $request->gender;
        // $family->relation = $request->relation;
        // $family->user_id = $user->id;
        // $family->save();

        return redirect()->route('lab.checkout')->with('success','Family Information added Successfully');
    }


    public function confirm(Request $request)
    {
        $user = Auth::guard('user')->user();
        
        $this->validate($request,[
            // 'family_id' => 'nullable|exists:families,id,user_id,'.$user->id,
            'name' => 'required|string',
            // 'age' => 'required|integer|min:1',
            'gender' => 'required',
            'phone' => 'required|string',
            'address' => 'required|string',
            'dob' => 'required',
        ]);
        
        if (Session::has('currency')) 
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }
        $lab_cart=Session::get('lab_cart');

        $vendor = User::where('is_vendor',2)->find($lab_cart->vendor_id);
        if(!$vendor){
            $request->session()->flash('unsuccess', 'Invalid Vendor');
            return redirect()->back()->withInput();
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
        
        $lab_order->customer_details=json_encode(["name"=>$request->name, "dob"=>$request->dob, "gender"=>$request->gender,"service_address"=>$request->address]);
        $lab_order->timing=$request->timing;

        $lab_order->currency_sign=$curr->sign;
        $lab_order->currency_value=$curr->value; 
        $lab_order->note = $request->note;   
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
        
        return redirect()->route('lab.payment',$lab_order->order_number);
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
