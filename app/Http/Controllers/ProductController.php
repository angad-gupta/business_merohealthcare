<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Subcategory;

use App\Childcategory;
use App\Gallery;
use App\Currency;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
          
        $prods = Product::orderBy('id','desc')->paginate(10);
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.index',compact('prods','sign'));
    }

    public function vendorindex()
    {
        $prods = Product::where('user_id','!=','')->orderBy('id','desc')->paginate(10);
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.vendorindex',compact('prods','sign'));
    }

    


    public function productsearch()
    {
        $q = Input::get('search');
        $prods = Product::where('name', 'LIKE', '%' . $q . '%')->orWhere('company_name', 'like', '%' . $q . '%')->orWhere('tags', 'like', '%' . $q . '%')
        ->orderBy('name')->paginate(10);
            // dd($prods);
        $prods->appends(['search' => $q]);
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.index', compact('prods','sign'));
    }

    public function productPriceRangeSearch()
    {
        $min = Input::get('min');
        $max = Input::get('max');
        $sign = Currency::where('is_default','=',1)->first();
        $prods = Product::where('status','=',1)->whereBetween('cprice', [$min,$max])->orderBy('cprice','asc')->paginate(10);
        $prods->appends(['min' => $min, 'max' => $max]);
        return view('admin.product.index', compact('prods','sign','min','max'));
    }


    public function vendorproductsearch()
    {
        $q = Input::get('search');

      
        $prods = Product::where('name', 'LIKE', '%' . $q . '%')->orWhere('company_name', 'like', '%' . $q . '%')->orWhere('tags', 'like', '%' . $q . '%')
        ->where('user_id','=',0)->paginate(10);
            // dd($prods);
        $prods->appends(['search' => $q]);
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.vendorindex', compact('prods','sign'));
    }

    public function deactive()
    {

        $prods = Product::where('status','=',0)->get();
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.deactive',compact('prods','sign'));
    }

    public function stock()
    {
        $prods = Product::where('status','=',1)->where('stock','=',0)->get();
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.stock',compact('prods','sign'));
    }

    public function create()
    {
     	$cats = Category::has('childs')->get();
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.create',compact('cats','sign'));
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
    // dd('fasdf');
        $this->validate($request, [
            'cprice' => 'required|numeric|min:1',
            'pprice' => 'nullable|numeric|min:1',
            'photo' => 'required',
            'company_name' => 'required',
            'highlights' => 'required',
            'product_quantity' => 'required',
            'purchase_limit' => 'nullable|integer|min:1',
            'childcategory_ids' => 'required|min:1',
            'childcategory_ids.*' => 'required|exists:childcategories,id',
            'sale_percentage' => 'required_if:discountCheck,1|numeric|nullable|min:1',
            'sale_stock' => 'required_if:discountCheck,1|nullable|numeric|min:1',
            'sale_from' => 'required_if:discountCheck,1|nullable|date_format:"Y/m/d h:i A"',
            'sale_to' => 'required_if:discountCheck,1|nullable|date_format:"Y/m/d h:i A"|after:sale_from'

        ],[
            'childcategory_ids.required' => 'Select atleast one category.',
            'childcategory_ids.min' => 'Select atleast one category.',
            'childcategory_ids.*.exists' => 'Invalid category'
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

        // if(in_array(null, $request->features) || in_array(null, $request->colors))
        // {
        //     $input['features'] = null;  
        //     $input['colors'] = null;
        // }
        // else 
        // {             
        //     $input['features'] = implode(',', $request->features);  
        //     $input['colors'] = implode(',', $request->colors);                 
        // }

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

        $prod->fill($input)->save();

        foreach($request->childcategory_ids as $childcategory_id){
            $cat = Childcategory::find($childcategory_id);
            $prod->childcategories()->attach($childcategory_id, ['category_id' => $cat->subcategory->category->id, 'subcategory_id' => $cat->subcategory->id]);
        }

        if($request->adv_price){
            $prod->prices()->createMany($request->pricings);
        }

        if($request->adv_bonus_price){
            $prod->prices()->createMany($request->pricings_bonus);
        
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

        Session::flash('success', 'New Product added successfully.');
        return redirect()->route('admin-prod-index');
    }

    public function edit($id)
    {
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

        $metatags = null;
        if($prod->meta_tag != null)
        {
            $metatags = explode(',', $prod->meta_tag);            
        }
        // if($prod->features!=null && $prod->colors!=null)
        // {
        //     $title = explode(',', $prod->features);
        //     $details = explode(',', $prod->colors);
        // }
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
        
        return view('admin.product.edit',compact('cats','prod','tags','metatags','sign','mescheck'));
    }

    public function update(UpdateValidationRequest $request, $id)
    {

        // dd($request->pricings_bonus);
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
        // if(!in_array(null, $request->features) && !in_array(null, $request->colors))
        // {             
        //     $input['features'] = implode(',', $request->features);  
        //     $input['colors'] = implode(',', $request->colors);                 
        // }
        // else
        // {
        //     if(in_array(null, $request->features) || in_array(null, $request->colors))
        //     {
        //         $input['features'] = null;  
        //         $input['colors'] = null;
        //     }
        //     else
        //     {
        //         $features = explode(',', $prod->features);
        //         $colors = explode(',', $prod->colors);
        //         $input['features'] = implode(',', $features);  
        //         $input['colors'] = implode(',', $colors);
        //     }
        // }  

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

        if($request->adv_bonus_price){
            // dd($prod->pricesbonus()->where('is_bonus_price','=','1'));
            $prod->pricesbonus()->where('is_bonus_price','=','1')->delete();
            // $prod->prices()->createMany($request->pricings);
            $prod->pricesbonus()->createMany($request->pricings_bonus);
        }

        Session::flash('success', 'Product '.$prod->name.' updated successfully.');

  
        if($request->user_id == 0){
            return redirect()->route('admin-prod-index');
        }else{
            return redirect()->route('admin-vendor-prod-index');
        }
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
        Session::flash('success', 'Product deleted successfully.');
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

    public function approval(Request $request)
    {
        // dd($request);
        $product_id_array = $request->input('id');

     
        foreach($product_id_array as $id){
            $prod = Product::findOrFail($id);
            if($prod->approval == 0){
                $prod->approval = 1;
                $prod->status = 1;
                $prod->update();
                $user = User::findOrFail($prod->user_id);
                $data = [
                'to' => $user->email,
                'subject' => 'Product is Succesfully Verfied',
                'body' => "<b>Hello ".$user->name.",</b>"."<br> Your Product are succesfully verified and approved by our team and is activated in our system. Please login to check your product status. Thankyou.",
                ];
                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);

            }
            else{
                $prod->approval = 0;
                $prod->status = 0;
                $prod->update();
            }
            }

            

       
            echo 'Product Approval Changed Successfully';
       
    }

    public function duplicate($id)
    {
        // dd($id);
        $product = Product::findOrFail($id);
        $newproduct = $product->replicate();
        $newproduct->save();
        return redirect()->back()->with('success','Successfully Duplicated Product Records.');

    }

    public function export(){
        return response()->download('productFormat.xlsx', 'productFormat.xlsx');
        
        Excel::create('productSaleFormat', function($excel) {
            $excel->sheet('Sheet1', function($sheet) {
                
                $sheet->row(1, array(
                    'Product ID','Product Name', 'Sale Starts At','Sale Ends At','Sale Percentage','Sale Stock'
                ));

                $sheet->row(1, function($row) {
                    $row->setFontWeight('bold');
                });

                $result = Product::where('status',1)->get();
                $data = [];
                foreach($result as $product){
                    $data []= [$product->id,$product->name];
                }
                $sheet->rows($data);

                $sheet->setColumnFormat(array(
                    'C2:C'.($result->count()+1) => 'yyyy/mm/dd hh:mm AM/PM',
                    'D2:D'.($result->count()+1) => 'yyyy/mm/dd hh:mm AM/PM'
                ));

                $sheet->setAutoSize(array(
                    'A', 'B'
                ));

                $sheet->setWidth([
                    'C' => 30,
                    'D' => 30,
                    'E' => 20,
                    'F' => 20
                ]);
              
                for ($i=0; $i<$result->count(); $i++){
                    $cellValidation = $sheet->getCell('C'.($i+2))->getDataValidation();
                    $cellValidation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE);
                    $cellValidation->setAllowBlank(true);
                    $cellValidation->setShowInputMessage(true);
                    $cellValidation->setShowErrorMessage(true);
                    $cellValidation->setErrorTitle("Input error.");
                    $cellValidation->setError("Must be in the format 'yyyy/mm/dd hh:ss AM/PM' eg: 25/01/2019 04:05 PM.");
                    $cellValidation->setPromptTitle('Date Format');
                    $cellValidation->setPrompt("Must be in the format 'yyyy/mm/dd hh:ss AM/PM' eg: 25/01/2019 04:05 PM");
                    $cellValidation->setOperator(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::OPERATOR_GREATERTHANOREQUAL);
                    $cellValidation->setFormula1('');

                    $cellValidation = $sheet->getCell('D'.($i+2))->getDataValidation();
                    $cellValidation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_DATE);
                    $cellValidation->setAllowBlank(true);
                    $cellValidation->setShowInputMessage(true);
                    $cellValidation->setShowErrorMessage(true);
                    $cellValidation->setErrorTitle("Input error.");
                    $cellValidation->setError("Must be in the format 'yyyy/mm/dd hh:ss AM/PM' eg: 25/01/2019 04:05 PM and greater than or equal to start date.");
                    $cellValidation->setPromptTitle('Date Format');
                    $cellValidation->setPrompt("Must be in the format 'yyyy/mm/dd hh:ss AM/PM' eg: 25/01/2019 04:05 PM and greater than or equal to start date.");
                    $cellValidation->setOperator(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::OPERATOR_GREATERTHANOREQUAL);
                    $cellValidation->setFormula1('=C'.($i+2));

                    $cellValidation = $sheet->getCell('E'.($i+2))->getDataValidation();
                    $cellValidation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
                    $cellValidation->setAllowBlank(true);
                    $cellValidation->setShowInputMessage(true);
                    $cellValidation->setShowErrorMessage(true);
                    $cellValidation->setErrorTitle("Input error.");
                    $cellValidation->setError("Must be between 1-100.");
                    $cellValidation->setPromptTitle('Invalid Format');
                    $cellValidation->setPrompt("Must be between 1-100.");
                    $cellValidation->setOperator(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::OPERATOR_BETWEEN);
                    $cellValidation->setFormula1(1);
                    $cellValidation->setFormula2(100);

                    $cellValidation = $sheet->getCell('F'.($i+2))->getDataValidation();
                    $cellValidation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
                    $cellValidation->setAllowBlank(true);
                    $cellValidation->setShowInputMessage(true);
                    $cellValidation->setShowErrorMessage(true);
                    $cellValidation->setErrorTitle("Input error.");

                    if($result[$i]['stock']){
                        $cellValidation->setError("Must be less than equal to ".$result[$i]['stock']);
                        $cellValidation->setPromptTitle('Invalid Entry');
                        $cellValidation->setPrompt("Must be less than equal to ".$result[$i]['stock']);
                        $cellValidation->setOperator(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::OPERATOR_LESSTHANOREQUAL);
                        $cellValidation->setFormula1($result[$i]['stock']);
                    }
                }
        
            });
            // $excel->sheet('Category Lists', function($sheet){
            //     $sheet->row(1, array(
            //         'Category', 'Sub Category','Child Category','Child Category Id'
            //     ));

            //     $result = ChildCategory::where('status',1)->get();
            //     $data = [];
            //     foreach($result as $child){
            //         $sub = $child->subcategory;
            //         $data []= [$sub->category->cat_name,$sub->sub_name,$child->child_name,$child->id];
            //     }
            //     $sheet->rows($data);
                
            // });
        })->export('xlsx');
        
        return redirect()->route('admin-prod-index');
    }

    public function import(){
        return view('admin.product.import');
    }

    public function upload(Request $request){
        // $this->validate($request, [
        //     'file' => 'required|mimes:xlsx, xls'
        // ]);  
        $flag = 0;
        
        Excel::load($request->file, function($reader) use (&$flag){
            $data = $reader->toArray();
            // dd($data);
            $products = [];
            // dd($data[693]['prod÷uct_highlights']);
            // $product = Product::findOrFail(1334);
            // $product->highlights = utf8_encode($data[693]['product_highlights']);
            // $product->save();
            // dd($product);

            // dd($data);
            
            foreach($data as $prod){
                $product = [];
                $product['name'] = $prod['product_name'];
                $product['sub_title'] = $prod['variant_key'];
                $product['generic_name'] = $prod['sku_genre'];
                $product['description'] = $prod['product_description']?"<p>".$prod['product_description']."</p>":'<p></p>';
                $product['cprice'] = $prod['product_current_price'];
                // $product['pprice'] = $prod['product_previous_price'];
                $product['company_name'] = $prod['product_company_name']?:'Unknown';
                $product['highlights'] = $prod['product_highlights']?$prod['product_highlights']:null;
                $product['product_quantity'] = $prod['product_quantity'];
                $product['stock'] = null;
                // $product['requires_prescription'] = ($prod['requires_prescription'] == 'Yes' ? 1 : 0);
                $product['purchase_limit'] = 30;
             
                $product['category']=$prod['sub_category']?$prod['sub_category']:'Medicine';
                $product['molecule']=$prod['molecule'];
                

                // $product['childcategory_ids'] = $prod['category'] ? explode(",",$prod['category']) : [];
                // $product['tags'] = $prod['product_tags'];

                if($prod['product_type']!=null)
                {
                    if($prod['product_type']!='Tablet' && $prod['product_type']!='Gel' && $prod['product_type']!='Injection' && $prod['product_type']!='Drops' && $prod['product_type']!='Capsule' && $prod['product_type']!='Syrup' && $prod['product_type']!='Infusion' && $prod['product_type']!='Cream' && $prod['product_type']!='Vaccine' && $prod['product_type']!='Soap' && $prod['product_type']!='Eye Drop' && $prod['product_type']!='Ointment' && $prod['product_type']!='Liquid' && $prod['product_type']!='Solution' && $prod['product_type']!='Oil' && $prod['product_type']!='Powder')
                    {
                          $product['photo']='default_images/default.png';
                        
                    }
                    else{
                        $product['photo']='default_images/'.$prod['product_type'].'.png';
                    }
                }
                else{
                    $product['photo']='default_images/default.png';
                }
                // $product['photo'] = $prod['product_type']?'default_images/'.$prod['product_type'].'.png':'default_images/default.png';
                $products []= $product;
            }

            $validator = Validator::make($products,[
                // '*.name' => 'required|string',
                // '*.description' => 'required',
                // '*.photo' => 'required',
                // '*.stock' => 'nullable|integer|min:0',
                // '*.purchase_limit' => 'nullable|integer|min:1',
                // '*.cprice' => 'required|numeric|min:1',
                // '*.pprice' => 'nullable|numeric|min:1',
                // '*.company_name' => 'required',
                // '*.highlights' => 'required',
                // '*.childcategory_ids' => 'required|min:1',
                // '*.childcategory_ids.*' => 'required|exists:childcategories,id',
    
            ],[
                // 'childcategory_ids.required' => 'Select atleast one category.',
                // 'childcategory_ids.min' => 'Select atleast one category.',
                // 'childcategory_ids.*.exists' => 'Invalid category'
            ]);
            
            if ($validator->fails()) {
                $flag = 0;
                Session::flash('unsuccess', 'There are some invalid entries. Please check and try again.');
            }
            else{
                $flag = 1;

        
                foreach($products as $product){
                    if($product['cprice']!=null && $product['molecule']!=null && $product['name']!='PRODUCT NAME*' && strlen($product['molecule'])<190)
                    {
                        if($product['category']=='Medicines' || $product['category']==null )
                        {
                            
                            $childcategories=Childcategory::where('child_name','LIKE',$product['molecule'])->get();
                            if($childcategories->count()>0){
                                $product['childcategory_ids']=[$childcategories->first()->id];

                            }
                            else{

                                $ch=new Childcategory;
                                $ch->child_name=$product['molecule'];
                                $ch->child_slug=str_slug($product['molecule']);
                                $ch->subcategory_id=90;
                                $ch->save();
                                $product['childcategory_ids']=[$ch->id];
                            }


                        }
                        else{
                            
                            
                            $subcategories=Subcategory::where('sub_name','LIKE',$product['category'])->get();
                            // dd($subcategories);
                            if($subcategories->count()>0)
                            {
                                $childcategories=Childcategory::where('child_name','LIKE',$product['molecule'])->get();
                                if($childcategories->count()>0)
                                {
                                    $product['childcategory_ids']=[$childcategories->first()->id];

                                }   
                                else{
                                    $ch=new Childcategory;
                                    $ch->child_name=$product['molecule'];
                                    $ch->child_slug=str_slug($product['molecule']);

                                    $ch->subcategory_id=$subcategories->first()->id;
                                    $ch->save();
                                    $product['childcategory_ids']=[$ch->id];
                                }

                            }
                            else{
                                $sb=new Subcategory;
                                $sb->sub_name=$product['category'];
                                $sb->sub_slug=str_slug($product['category']);
                                $sb->category_id=35;
                                $sb->save();

                                $ch=new Childcategory;
                                $ch->child_name=$product['molecule'];
                                $ch->child_slug=str_replace($product['molecule'],' ', '-');

                                $ch->subcategory_id=$sb->id;
                                $ch->save();

                                $product['childcategory_ids']=[$ch->id];
                            }
                        }
                        $prod = new Product;

                        error_log(json_encode($prod));
                        $prod->fill($product)->save();
                        // dd($prod);

                        foreach($product['childcategory_ids'] as $childcategory_id){
                            $cat = Childcategory::find($childcategory_id);
                            $prod->childcategories()->attach($childcategory_id, ['category_id' => $cat->subcategory->category->id, 'subcategory_id' => $cat->subcategory->id]);
                        }
                    }
            
                }
                Session::flash('success', 'New Products added successfully.');
            }
        });
        
        if($flag) 
            return redirect()->route('admin-prod-index');
        else
            return redirect()->back();
    }

    public function categorychange(Request $request){

        $product_id_array = $request->input('id');

        $childcategory_ids = $request->input('child_category_id');

        foreach($product_id_array as $id ){
            $prod = Product::findOrFail($id);

            $arr = [];
            foreach($childcategory_ids as $childcategory_id){
                $cat = Childcategory::find($childcategory_id);

                $arr[$childcategory_id] = ['category_id' => $cat->subcategory->category->id, 'subcategory_id' => $cat->subcategory->id];
            }

            $prod->childcategories()->sync($arr);
        }

        echo 'Product Category Changed Successfully';
    }

    public function childcategorysearch(Request $request)
    {
        // dd($request->category_id);
        $childcat = Childcategory::where('id','=',$request->childcategory_id)->whereHas('subcategory.category',function($query){
            $query->where('cat_name','!=','Medicines');
        })->firstOrFail();
        $prods = $childcat->products()->where('status','=',1)->distinct()->orderBy('name')->orderBy('id','desc')->paginate(100);
        $prods->appends(['category_id' => $request->category_id]);
        $sign = Currency::where('is_default','=',1)->first();
        return view('admin.product.index',compact('prods','sign'));
    }
}
