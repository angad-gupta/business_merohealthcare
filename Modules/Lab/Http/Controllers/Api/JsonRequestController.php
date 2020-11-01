<?php

namespace Modules\Lab\Http\Controllers\Api;

use Modules\Lab\Entities\LabCart as Cart;
use App\Compare;
use App\Currency;
use App\Generalsetting;
use App\Http\Controllers\Controller;
use App\PaymentGateway;
use Modules\Lab\Entities\LabProductUser as Product;
use Modules\Lab\Entities\LabProduct;
use Illuminate\Http\Request;
use App\User;
use Session;

class JsonRequestController extends Controller
{
    
    public function transhow()
    {
        $id = $_GET['id'];

        $oldCart = Session::has('lab_cart') ? Session::get('lab_cart') : null;
        $data = [];

        if (Session::has('currency')) 
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }

        if($id == 'cod'){
            Session::forget('gateway'); 
            $data[0] = round($oldCart->total_with_discount()* $curr->value,2);       

            return response()->json(['text' => '','data' => $data], 200);
        }

        $pay = PaymentGateway::where('status',1)->findOrFail($id);
        $pay->discount = 0;

        if($pay->discount_value){

            $total = $oldCart->totalPrice;
            if(!$pay->min_purchase_amount ||  $total >= $pay->min_purchase_amount){
                if($pay->discount_type === 0)
                {
                    $pay->price = (int)$pay->discount_value;
                    $val = $total / 100;
                    $sub = round($val * $pay->price, 2);
                    $total = $total - $sub;
                    $data[0] = round($total * $curr->value,2);
                    $data[1] = round($sub * $curr->value,2);
                    $data[2] = $pay->price."%";

                    $pay->discount = $sub;
                }
                else{
                    if($total < $pay->discount_value) 
                        $sub = $total;
                    else
                        $sub = $pay->discount_value;

                    $total = $total - $sub;
                    $data[0] = round($total * $curr->value,2);
                    $data[1] = round($sub * $curr->value, 2);
                    $data[2] = $curr->sign . round($pay->discount_value* $curr->value,2);   
                    
                    $pay->discount = $sub;
                }
            }
        }
        Session::put('gateway', $pay); 
        $data[0] = round($oldCart->total_with_discount()* $curr->value,2);       

        return response()->json(['text' => $pay->text,'data' => $data], 200);
    }  

    public function addcart(Request $request)
    {
        if($request->reset_cart) Session::forget('lab_cart');

        $id = $request->test_id;
        
        $prod = Product::where('id','=',$id)->whereHas('vendor',function($q){
            $q->where('users.is_vendor','=',2);
        })->where('status',1)->first();

        if(!$prod){
            return response()->json(['error' => 'Product is unavailable'],422);             
        }

        $oldCart = Session::has('lab_cart') ? Session::get('lab_cart') : null;

        $cart = new Cart($oldCart);

        if($oldCart && $cart->vendor_id != $prod->user_id){
            return response()->json(['error' => 'Product cannot be added to this cart'],422);             
        }

        $prod->price = $prod->cprice;
        $prod->name = $prod->type->name;

        $cart->add($prod, $prod->id);

        Session::put('lab_cart',$cart);

        $data[0] = $cart->totalPrice;
        $data[1] = view('lab::front.partials.cart')->with('products',$cart->items)->render();
        $data[2] = count($cart->items); 

        return response()->json($data);           
    }

    public function addpackage(Request $request)
    {
        Session::forget('lab_cart');

        $ids = $request->test_ids;
        $vendor_id = $request->vendor_id;

        $cart = new Cart(null);

        foreach($ids as $id){
            $prod = Product::where('user_id','=',$vendor_id)->where('product_id','=',$id)->where('status',1)->first();
            
            $prod->price = $prod->cprice;
            $prod->name = $prod->type->name;

            $cart->add($prod, $prod->id);
        }

        Session::put('lab_cart',$cart);

        return response()->json('success');           
    }

    public function removecart(Request $request)
    {
        $id = $request->test_id;

        $oldCart = Session::has('lab_cart') ? Session::get('lab_cart') : null;
        
        $cart = new Cart($oldCart);
          
        $cart->removeItem($id);
        
        if (count($cart->items) > 0) {
            Session::put('lab_cart', $cart);
            $data[0] = $cart->totalPrice;
            $data[1] = $cart->items;   
            $data[2] = count($cart->items);
            return response()->json($data);  
        } else {
            Session::forget('lab_cart');
            $data[0] = 0.00;
            $data[1] = null;   
            return response()->json($data); 
        }          
    } 

    public function emptycart()
    {
        Session::forget('lab_cart');
        return 'success';        
    } 

    public function compare(Request $request)
    {
        $ids = $request->test_ids;
        // dd(array($ids));
        $products = LabProduct::whereIn('id',$ids)->where('status',1)->get();

        $vendors = User::whereNotNull('email_verified_at')->where('is_vendor',2)->orderBy('id')->get();

        $vendor_products = [];
        $options = collect();

        foreach($products as $product){
            $option = $product->options()->whereHas('vendor', function ($query) {
                $query->whereNotNull('email_verified_at')->where('users.is_vendor', 2);
            })->get();

            $options = $options->merge($option);
        }

        $options = $options->groupBy('user_id');
        
        foreach($options as $id => $item){
            if($request->city){
                $vendor = $vendors->where('id',$id)->first();
                $areas = $vendor->service_areas ? json_decode($vendor->service_areas) : [];
    
                if(in_array($request->city,$areas) && $item->count() == count($ids)) $vendor_products[$id] = $item;
            }
            else if($item->count() == count($ids)) $vendor_products[$id] = $item;
        }


        $data = ['lab_tests'=>$products,'vendors'=>$vendors,'vendor_products'=>$vendor_products];
        
        return response()->json($data,200);   
   
    }

    public function comparesearch(Request $request)
    {
        $ids = $request->test_ids;
        
        $products = LabProduct::whereIn('id',$ids)->where('status',1)->get();

        $vendors = User::whereNotNull('email_verified_at')->where('is_vendor',2)->orderBy('id')->get();

        $vendor_products = [];
        $options = collect();

        foreach($products as $product){
            $option = $product->options()->whereHas('vendor', function ($query) {
                $query->whereNotNull('email_verified_at')->where('users.is_vendor', 2);
            })->get();

            $options = $options->merge($option);
        }

        $options = $options->groupBy('user_id');
        
        foreach($options as $id => $item){
            if($request->city){
                $vendor = $vendors->where('id',$id)->first();
                $areas = $vendor->service_areas ? json_decode($vendor->service_areas) : [];
    
                if(in_array($request->city,$areas) && $item->count() == count($ids)) $vendor_products[$id] = $item;
            }
            else if($item->count() == count($ids)) $vendor_products[$id] = $item;
        }


        $data = ['lab_tests'=>$products,'vendors'=>$vendors,'vendor_products'=>$vendor_products];
        
        return response()->json($data,200);   
   
    }

    public function removecompare(Request $request)
    {
        $data[0] = 0;
        $oldCompare = Session::has('lab_compare') ? Session::get('lab_compare') : null;
        $compare = new Compare($oldCompare);
        
        $id = $request->test_id;      
        $compare->removeItem($id);

        $data[1] = count($compare->items);  
        if (count($compare->items) > 0) {
            Session::put('lab_compare', $compare);
            return response()->json($data);  
        } else {
            $data[0] = 1;
            Session::forget('lab_compare');
            return response()->json($data); 
        }     
    }

    public function clearcompare()
    {
        Session::forget('lab_compare');
    }
  
    public function suggest()
    {
        $search = $_GET['search'];     
        $data = Product::where('name', 'like', '%' . $search . '%')
                ->where('status','=',1)->orderBy('id','desc')->take(10)->get();
        $gs = Generalsetting::findOrFail(1);

        if (Session::has('currency')) 
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }

        $oldCart = Session::has('lab_cart') ? Session::get('lab_cart') : null;
        $cart = new Cart($oldCart);
        
        // foreach($data as $key => $value)
        // {
        //     if($value->user_id != 0)
        //     {
        //         if($value->user->is_vendor != 2)
        //         {
        //             unset($data[$key]);
        //         }
        //     }
        // }
        $html = view('includes.search')->with('products',$data)->with('curr',$curr)->with('gs',$gs)->with('lab_cart',$cart)->render();
        return response()->json(['html' => $html]);      
    }

    public function search()
    {
        $search = $_GET['query'];     
        $data = Product::where('name', 'like', '%' . $search . '%')
                ->where('user_id',0)
                ->where('status','=',1)->orderBy('id','desc')->take(5)->get();

        return response()->json($data);      
    }
}