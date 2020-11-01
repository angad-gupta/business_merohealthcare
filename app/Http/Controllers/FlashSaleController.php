<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\FlashSale;
use App\Currency;
use Illuminate\Support\Facades\Session;

class FlashSaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $sales = FlashSale::orderBy('id','desc')->get();
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.flashsales.index',compact('sales','sign'));
    }

    public function create()
    {
        $prods = Product::where('status',1)->orderBy('id','desc')->get();

        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.flashsales.create',compact('prods','sign'));
    }

    public function status($id1,$id2)
    {
        $prod = FlashSale::findOrFail($id1);
        $prod->status = $id2;
        $prod->update();
        Session::flash('success', 'Successfully Updated The Status.');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cprice' => 'required|numeric|min:1',
            'pprice' => 'nullable|numeric|min:1',
            'photo' => 'required',
            'company_name' => 'required',
            'highlights' => 'required',
            'childcategory_ids' => 'required|min:1',
            'childcategory_ids.*' => 'required|exists:childcategories,id'
        ],[
            'childcategory_ids.required' => 'Select atleast one category.',
            'childcategory_ids.min' => 'Select atleast one category.',
            'childcategory_ids.*.exists' => 'Invalid category'
        ]);

        if($request->adv_price){
            $this->validate($request, [
                'pricings' => 'required|min:1',
                'pricings.*.min_qty' => 'required|integer|min:2',
                'pricings.*.type' => 'required|in:1,0',
                'pricings.*.value' => 'required|numeric|min:0'
            ]);
        }

        $prod = new FlashSale;
        $sign = Currency::where('is_default','=',1)->first();
        $input = $request->all();

        if(in_array(null, $request->features) || in_array(null, $request->colors))
        {
            $input['features'] = null;  
            $input['colors'] = null;
        }
        else 
        {             
            $input['features'] = implode(',', $request->features);  
            $input['colors'] = implode(',', $request->colors);                 
        }

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
        $prod->fill($input)->save();

        foreach($request->childcategory_ids as $childcategory_id){
            $cat = Childcategory::find($childcategory_id);
            $prod->childcategories()->attach($childcategory_id, ['category_id' => $cat->subcategory->category->id, 'subcategory_id' => $cat->subcategory->id]);
        }

        if($request->adv_price){
            $prod->prices()->createMany($request->pricings);
        }
        if($request->attrcheck){
            $prod->attributes()->createMany($input['attributes']);
        }

        Session::flash('success', 'New Sale added successfully.');
        return redirect()->route('admin-prod-index');
    }

    public function edit($id)
    {
     	$cats = Category::has('childs')->get();        
        $prod = FlashSale::findOrFail($id);
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
        
        return view('admin.flashsales.edit',compact('cats','prod','size','colrs','tags','metatags','title','details','sign','title1','details1','mescheck'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cprice' => 'required|numeric|min:1',
            'pprice' => 'nullable|numeric|min:1',
            'company_name' => 'required',
            'highlights' => 'required',
            'childcategory_ids' => 'required|min:1',
            'childcategory_ids.*' => 'required|exists:childcategories,id'
        ],[
            'childcategory_ids.required' => 'Select atleast one category.',
            'childcategory_ids.min' => 'Select atleast one category.',
            'childcategory_ids.*.exists' => 'Invalid category'
        ]);

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
        if(!in_array(null, $request->features) && !in_array(null, $request->colors))
        {             
            $input['features'] = implode(',', $request->features);  
            $input['colors'] = implode(',', $request->colors);                 
        }
        else
        {
            if(in_array(null, $request->features) || in_array(null, $request->colors))
            {
                $input['features'] = null;  
                $input['colors'] = null;
            }
            else
            {
                $features = explode(',', $prod->features);
                $colors = explode(',', $prod->colors);
                $input['features'] = implode(',', $features);  
                $input['colors'] = implode(',', $colors);
            }
        }  

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
            if($prod->photo != null)
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
        
        if(!$request->adv_price) $input['adv_price'] = 0;
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

        Session::flash('success', 'Product updated successfully.');
        return redirect()->route('admin-prod-index');
    }

    public function feature(Request $request, $id)
    {
        $prod = Product::findOrFail($id);
        $input = $request->all(); 

            if($request->featured == "")
            {
                $input['featured'] = 0;
            }
            if($request->hot == "")
            {
                $input['hot'] = 0;
            }
            if($request->best == "")
            {
                $input['best'] = 0;
            }
            if($request->top == "")
            {
                $input['top'] = 0;
            }
            if($request->latest == "")
            {
                $input['latest'] = 0;
            }
            if($request->big == "")
            {
                $input['big'] = 0;
            } 
                 
        $prod->update($input);
        Session::flash('success', 'Product Highlight Updated Successfully.');
        return redirect()->route('admin-prod-index');
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
                    if (file_exists(public_path().'/assets/images/'.$prod->photo)) {
                        unlink(public_path().'/assets/images/'.$prod->photo);
                    }
                if($prod->file != null){
                    if (file_exists(public_path().'/assets/files/'.$prod->file)) {
                        unlink(public_path().'/assets/files/'.$prod->file);
                    }
                }
        $prod->delete();
        Session::flash('success', 'Product deleted successfully.');
        return redirect()->back();
    }
}
