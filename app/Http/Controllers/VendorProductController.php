<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Currency;
use Auth;
use App\Notification;
use Illuminate\Support\Facades\Input;
use App\Category;
use App\Subcategory;
use App\Classes\GeniusMailer;
use App\Childcategory;
use App\Gallery;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\GeneralSetting;

class VendorProductController extends Controller
{
   public function index(){
    $user = Auth::guard('user')->user();
    $prods = Product::where('user_id','=',$user->id)->orderBy('id','desc')->paginate(10);
    $sign = Currency::where('is_default','=',1)->first();
    return view('user.vendorproduct.index',compact('prods','cats','sign'));
   }

   public function create()
   {
        $cats = Category::has('childs')->get();
       $sign = Currency::where('is_default','=',1)->first();
       return view('user.vendorproduct.create',compact('cats','sign'));
   }

   public function status($id1,$id2)
   {
       $prod = Product::findOrFail($id1);
       $prod->status = $id2;
       $prod->update();
       Session::flash('success', 'Successfully Updated The Status.');
       return redirect()->back();
   }

   public function store(StoreValidationRequest $request)
   {
    //    dd($request);
       $this->validate($request, [
           'cprice' => 'required|numeric|min:1',
           'pprice' => 'nullable|numeric|min:1',
           'photo' => 'required',
           'company_name' => 'required',
           'highlights' => 'required',
           'product_quantity' => 'required',
           'purchase_limit' => 'nullable|integer|min:1',
        //    'childcategory_ids' => 'required|min:1',
        //    'childcategory_ids.*' => 'required|exists:childcategories,id',
            'sale_percentage' => 'required_if:discountCheck,1|numeric|nullable|min:1',
           'sale_stock' => 'required_if:discountCheck,1|nullable|numeric|min:1',
           'sale_from' => 'required_if:discountCheck,1|nullable|date_format:"Y/m/d h:i A"',
           'sale_to' => 'required_if:discountCheck,1|nullable|date_format:"Y/m/d h:i A"|after:sale_from'

       ]);

       if($request->stock){
           $this->validate($request, [
               'sale_stock' => 'required_if:discountCheck,1|nullable|numeric|min:1|max:'.$request->stock ? : '',
           ]);
       }

       if($request->adv_price){
           $this->validate($request, [
               'pricings' => 'required|min:1',
               'pricings.*.min_qty' => 'required|integer|min:2',
               'pricings.*.type' => 'required|in:1,0',
               'pricings.*.value' => 'required|numeric|min:0'
           ]);
       }

       if($request->attrcheck){
           $this->validate($request, [
               'attributes' => 'required|min:1',
               'attributes.*.name' => 'required',
               'attributes.*.value' => 'required',
           ]);
       }

       $prod = new Product;
       $sign = Currency::where('is_default','=',1)->first();
       $input = $request->all();

    //    if(in_array(null, $request->features) || in_array(null, $request->colors))
    //    {
    //        $input['features'] = null;  
    //        $input['colors'] = null;
    //    }
    //    else 
    //    {             
    //        $input['features'] = implode(',', $request->features);  
    //        $input['colors'] = implode(',', $request->colors);                 
    //    }

       if(empty($request->scheck ))
       {
           $input['size'] = null;
       }
       else{
           $input['size'] = implode(',', $request->size); 
       }


       if(empty($request->colcheck ))
       {
           $input['color'] = null;
       }
       else{
           $input['color'] = implode(',', $request->color); 
       }

       if ($file = $request->file('photo')) 
       {              
           $name = time().$file->getClientOriginalName();
           $file->move('assets/images',$name);           
           $input['photo'] = $name;
       }       
       
       if (!empty($request->tags)) 
       {
           $input['tags'] = implode(',', $request->tags);       
       }  

       if ($request->pccheck == ""){
           $input['product_condition'] = 0;
       }
       if ($request->shcheck == ""){
           $input['ship'] = null;
       }  
       if (!empty($request->meta_tag)) 
       {
           $input['meta_tag'] = implode(',', $request->meta_tag);       
       }  
       if ($request->mescheck == "") 
       {
           $input['measure'] = null;    
       } 
       if ($request->secheck == "") 
       {
           $input['meta_tag'] = null;
           $input['meta_description'] = null;         
       } 

       $input['cprice'] = ($input['cprice'] / $sign->value);
       if($input['pprice']) $input['pprice'] = ($input['pprice'] / $sign->value);     
       
       // $input['requires_prescription'] = $request->requires_prescription ? 1 : 0;

       if(!$request->discountCheck){
           $input['sale_percentage'] = null;
           $input['sale_stock'] = null;
           $input['sale_from'] = null;
           $input['sale_to'] = null;
       }

       // if($request->product_quantity){
       //     $input['product_quantity'] = 
       // }

       $prod->status = 0;
       $prod->approval = 0;

       $prod->fill($input)->save();
  

    //    foreach($request->childcategory_ids as $childcategory_id){
    //        $cat = Childcategory::find($childcategory_id);
    //        $prod->childcategories()->attach($childcategory_id, ['category_id' => $cat->subcategory->category->id, 'subcategory_id' => $cat->subcategory->id]);
    //    }

       if($request->adv_price){
           $prod->prices()->createMany($request->pricings);
       }
       if($request->attrcheck){
           $prod->attributes()->createMany($input['attributes']);
       }

       $lastid = $prod->id;
       if ($files = $request->file('gallery')){
           foreach ($files as  $key => $file){
               if(in_array($key, $request->galval))
               {
                   $gallery = new Gallery;
                   $name = time().$file->getClientOriginalName();
                   $file->move('assets/images/gallery',$name);
                   $gallery['photo'] = $name;
                   $gallery['product_id'] = $lastid;
                   $gallery->save();
               }
           }
       }

       $notification = new Notification;
       $notification->vendor_product_id = $prod->id;
       $notification->save();

       $user = Auth::guard('user')->user();

       $data = [
        'to' => $user->email,
        'subject' => 'Your Product is Uploaded Success!',
        'body' => "<b>Hello ".$user->name.",</b>"."<br> You have successfully uploaded your product to merohealthcare system. We will verify it and inform you through our team. Please have patience. Thankyou.",
        ];
        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);

        $gs = Generalsetting::findOrFail(1);

        $data = [
            'to' => $gs->email,
            'subject' => 'New Product is Added From Vendor!',
            'body' => "<b>Hello Admin,</b>"."<br> New Product is Added From Vendor Please check and verify it from Admin panel. Thankyou.",
            ];
            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);

       Session::flash('success', 'New Product added successfully.');
       return redirect()->route('user-vendor-product.index');
   }

   public function edit($id)
   {
    //    dd($id);
       $cats = Category::has('childs')->get();        
       $prod = Product::findOrFail($id);
       $sign = Currency::where('is_default','=',1)->first();
       if($prod->size != null)
       {
           $size = explode(',', $prod->size);            
       }
       if($prod->color != null)
       {
           $colrs = explode(',', $prod->color);            
       }
       if($prod->tags != null)
       {
           $tags = explode(',', $prod->tags);            
       }
       if($prod->meta_tag != null)
       {
           $metatags = explode(',', $prod->meta_tag);            
       }
       if($prod->features!=null && $prod->colors!=null)
       {
           $title = explode(',', $prod->features);
           $details = explode(',', $prod->colors);
       }
       if($prod->license!=null && $prod->license_qty!=null)
       {
           $title1 = explode(',,', $prod->license);
           $details1 = explode(',', $prod->license_qty);
       }
       $mescheck  = 1;
       $string = $prod->measure;
       if($prod->measure == 'Litre')
       {
       $mescheck  = 0;
       }
       if($prod->measure == 'Pound')
       {
       $mescheck  = 0;
       }
       if($prod->measure == 'Gram')
       {
       $mescheck  = 0;
       }
       if($prod->measure == 'Kilogram')
       {
       $mescheck  = 0;
       }
       
       return view('user.vendorproduct.edit',compact('cats','prod','size','colrs','tags','metatags','title','details','sign','title1','details1','mescheck'));
   }


   public function update(UpdateValidationRequest $request, $id)
   {
       $this->validate($request, [
           'cprice' => 'required|numeric|min:1',
           'pprice' => 'nullable|numeric|min:1',
           'company_name' => 'required',
           'highlights' => 'required',
           'purchase_limit' => 'nullable|integer|min:1',
           'childcategory_ids' => 'required|min:1',
           'childcategory_ids.*' => 'required|exists:childcategories,id',
           'sale_percentage' => 'required_if:discountCheck,1|numeric|nullable|min:1',
           'sale_stock' => 'required_if:discountCheck,1|nullable|numeric|min:0',
           'sale_from' => 'required_if:discountCheck,1|nullable|date_format:"Y/m/d h:i A"',
           'sale_to' => 'required_if:discountCheck,1|nullable|date_format:"Y/m/d h:i A"|after:sale_from'
       ],[
           'childcategory_ids.required' => 'Select atleast one category.',
           'childcategory_ids.min' => 'Select atleast one category.',
           'childcategory_ids.*.exists' => 'Invalid category'
       ]);

       if($request->stock){
           $this->validate($request, [
               'sale_stock' => 'required_if:discountCheck,1|nullable|numeric|min:0|max:'.$request->stock ? : '',
           ]);
       }

       if($request->adv_price){
           $this->validate($request, [
               'pricings' => 'required|min:1',
               'pricings.*.min_qty' => 'required|integer|min:2',
               'pricings.*.type' => 'required|in:1,0',
               'pricings.*.value' => 'required|numeric|min:0'
           ]);
       }

       if($request->attrcheck){
           $this->validate($request, [
               'attributes' => 'required|min:1',
               'attributes.*.name' => 'required',
               'attributes.*.value' => 'required',
           ]);
       }

       $prod = Product::findOrFail($id);
       $sign = Currency::where('is_default','=',1)->first();
       $input = $request->all();
       if ($request->galdel == 1){
           $gals = Gallery::where('product_id',$id)->get();
           foreach ($gals as $gal) {
               if (file_exists(public_path().'/assets/images/'.$gal->photo)) {
                   unlink(public_path().'/assets/images/'.$gal->photo);
               }
               $gal->delete();
           }
           
       }
    //    if(!in_array(null, $request->features) && !in_array(null, $request->colors))
    //    {             
    //        $input['features'] = implode(',', $request->features);  
    //        $input['colors'] = implode(',', $request->colors);                 
    //    }
    //    else
    //    {
    //        if(in_array(null, $request->features) || in_array(null, $request->colors))
    //        {
    //            $input['features'] = null;  
    //            $input['colors'] = null;
    //        }
    //        else
    //        {
    //            $features = explode(',', $prod->features);
    //            $colors = explode(',', $prod->colors);
    //            $input['features'] = implode(',', $features);  
    //            $input['colors'] = implode(',', $colors);
    //        }
    //    }  

       if(empty($request->scheck ))
       {
           $input['size'] = null;
       }
       else{
           if (!empty($request->size)) 
               {
               $input['size'] = implode(',', $request->size);       
               }  
           if (empty($request->size)) 
               {
               $input['size'] = null;       
               }  
       }

       if(empty($request->colcheck ))
       {
           $input['color'] = null;
       }
       else{
           if (!empty($request->color)) 
               {
               $input['color'] = implode(',', $request->color);       
               }  
           if (empty($request->color)) 
               {
               $input['color'] = null;       
               }  
       }

       if ($file = $request->file('photo')) 
       {              
           $name = time().$file->getClientOriginalName();
           $file->move('assets/images',$name);   
           if($prod->photo != null && strpos($prod->photo,'default_images/') === false)
           {
               if (file_exists(public_path().'/assets/images/'.$prod->photo)) {
                   unlink(public_path().'/assets/images/'.$prod->photo);
               }
           }          
           $input['photo'] = $name;
       }       
        
       if (!empty($request->tags)) 
       {
           $input['tags'] = implode(',', $request->tags);       
       }  
       if (empty($request->tags)) 
       {
           $input['tags'] = null;       
       }
       if ($request->pccheck == ""){
           $input['product_condition'] = 0;
       }
       if ($request->shcheck == ""){
           $input['ship'] = null;
       }  
       if (!empty($request->meta_tag)) 
        {
           $input['meta_tag'] = implode(',', $request->meta_tag);       
        }  
       if ($request->secheck == "") 
        {
           $input['meta_tag'] = null;
           $input['meta_description'] = null;         
        }   
       if ($request->mescheck == "") 
        {
           $input['measure'] = null;    
        } 
       $input['cprice'] = $input['cprice'] / $sign->value;
       
       if($input['pprice']) $input['pprice'] = $input['pprice'] / $sign->value; 

       // $input['requires_prescription'] = $request->requires_prescription ? 1 : 0;
       
       if(!$request->adv_price) $input['adv_price'] = 0;

       if(!$request->discountCheck){
           $input['sale_percentage'] = null;
           $input['sale_stock'] = null;
           $input['sale_from'] = null;
           $input['sale_to'] = null;
       }

        //return $input; 
       $prod->update($input);

       $arr = [];
       foreach($request->childcategory_ids as $childcategory_id){
           $cat = Childcategory::find($childcategory_id);

           $arr[$childcategory_id] = ['category_id' => $cat->subcategory->category->id, 'subcategory_id' => $cat->subcategory->id];
       }

       $prod->childcategories()->sync($arr);

       if($request->adv_price){
           $prod->prices()->delete();

           $prod->prices()->createMany($request->pricings);
       }



       Session::flash('success', 'Vendor Product updated successfully.');
       return redirect()->route('user-vendor-product.index');
   }

   public function productsearch()
   {

       $q = Input::get('search');
       $user = Auth::guard('user')->user();

     
       $prods = Product::where('name', 'LIKE', '%' . $q . '%')->where('user_id','=',$user->id)->orWhere('company_name', 'like', '%' . $q . '%')->orWhere('tags', 'like', '%' . $q . '%')
       ->orderBy('name')->paginate(10);
           // dd($prods);
       $prods->appends(['search' => $q]);
       $sign = Currency::where('is_default','=',1)->first();
       return view('user.vendorproduct.index', compact('prods','sign'));
   }

   public function destroy($id)
    {
        $prod = Product::findOrFail($id);
        if($prod->galleries->count() > 0)
        {
            foreach ($prod->galleries as $gal) {
                    if (file_exists(public_path().'/assets/images/gallery/'.$gal->photo)) {
                        unlink(public_path().'/assets/images/gallery/'.$gal->photo);
                    }
                $gal->delete();
            }

        }
        if($prod->reviews->count() > 0)
        {
            foreach ($prod->reviews as $gal) {
                $gal->delete();
            }
        }
        if($prod->wishlists->count() > 0)
        {
            foreach ($prod->wishlists as $gal) {
                $gal->delete();
            }
        }
        if($prod->clicks->count() > 0)
        {
            foreach ($prod->clicks as $gal) {
                $gal->delete();
            }
        }
        if($prod->comments->count() > 0)
        {
            foreach ($prod->comments as $gal) {
            if($gal->replies->count() > 0)
            {
                foreach ($gal->replies as $key) {
                    if($key->subreplies->count() > 0)
                    {
                        foreach ($key->subreplies as $key1) {
                            $key1->delete();
                        }
                    }
                    $key->delete();
                }
            }
                $gal->delete();
            }
        }
        if($prod->photo && strpos($prod->photo,'default_images/') === false){
            if (file_exists(public_path().'/assets/images/'.$prod->photo)) {
                unlink(public_path().'/assets/images/'.$prod->photo);
            }
        }
        if($prod->file != null){
            if (file_exists(public_path().'/assets/files/'.$prod->file)) {
                unlink(public_path().'/assets/files/'.$prod->file);
            }
        }
        $prod->delete();
        Session::flash('success', 'Vendor Product deleted successfully.');
        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        $product_id_array = $request->input('id');
        $product = Product::whereIn('id', $product_id_array);
        if($product->delete())
        {
            echo 'Product Deleted Successfully';
        }

        
    }

    public function multiplestatus(Request $request)
    {
        
        $product_id_array = $request->input('id');
        foreach($product_id_array as $id){
            $prod = Product::findOrFail($id);
            if($prod->status == 0){
                $prod->status = 1;
                $prod->update();
            }
            else{
                $prod->status = 0;
                $prod->update();
            }
            }
       
            echo 'Product Status Changed Successfully';
    }

}
