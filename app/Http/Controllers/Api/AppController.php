<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Brand;
use App\Category;
use App\Childcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Image;
use App\Portfolio;
use App\Product;
use App\ProductClick;
use App\Service;
use App\Slider;
use App\Subcategory;
use App\User;
use Carbon\Carbon;
use App\GeneralSetting;
use App\CategoryProduct;
use App\Prescription;
use App\Prescriptionfile;
use App\PrescriptionfilePrescription;
use App\Notification;
use App\Classes\GeniusMailer;
use Auth;

use \League\OAuth2\Server\ResourceServer;
use \Laravel\Passport\TokenRepository;
use \Laravel\Passport\Guards\TokenGuard;
use \Laravel\Passport\ClientRepository;

class AppController extends Controller
{
    private function getUser($bearerToken) {
        $tokenguard = new TokenGuard(
            \App::make(ResourceServer::class),
            Auth::createUserProvider('users'),
            \App::make(TokenRepository::class),
            \App::make(ClientRepository::class),
            \App::make('encrypter')
        );
        $request = Request::create('/');
        $request->headers->set('Authorization', 'Bearer ' . $bearerToken);
        return $tokenguard->user($request);
    }

    public function HomePage()
    {
        $data=[];
        try {
            $data['ads'] = Portfolio::all();
            $sls = Slider::first();
                    $id1 = $sls->id;
                    $data['sliders'] = Slider::where('id','>',$id1)->get();
                    $data['brands'] = Brand::all();
                    // $data['banner'] = Banner::findOrFail(1);
                    // $data['services'] = Service::all();
                    $data['featured_products'] = Product::where('featured','=',1)->where('status','=',1)->with('combo_prices')->orderBy('id','desc')->take(8)->get();
                    $data['best_products'] = Product::where('best','=',1)->where('status','=',1)->with('combo_prices')->orderBy('id','desc')->take(8)->get();
                    $data['top_products'] = Product::where('top','=',1)->where('status','=',1)->with('combo_prices')->orderBy('id','desc')->take(8)->get();
                    $data['hot_products'] = Product::where('hot','=',1)->where('status','=',1)->with('combo_prices')->orderBy('id','desc')->take(8)->get();
                    $data['latest_products'] = Product::where('latest','=',1)->where('status','=',1)->with('combo_prices')->orderBy('id','desc')->take(8)->get();
                    $data['big_products'] = Product::where('big','=',1)->where('status','=',1)->with('combo_prices')->orderBy('id','desc')->take(8)->get();
                    $data['imgs'] = Image::all();
                    $data['success'] = true;
                    $data['categories']=Category::where("status",1) ->get();
            return response()->json($data,200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            $data['success'] = false;
            $data['message'] = 'Server Error';
            return response()->json($data,500);
        }
    }

    public function Categories($slug)
    {
        $data = [];
        try {
            $data['category'] = Category::where('cat_slug','=',$slug)->first();  
            $data['sub_categories'] = Subcategory::where('category_id',$data['category']->id)->with('childs')->get();
            $data['success'] = true;
            return response()->json($data,200);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            $data['success'] = false;
            return response()->json($data,500);
        }
    }



    public function Product($id)
    {
        $data = [];
        try {
            $data['product'] = Product::with('combo_prices')->findOrFail($id);

            if($data['product']->size != null)
            {
                $size = explode(',', $data['product']->size);            
            }  
            if($data['product']->color != null)
            {
                $color = explode(',', $data['product']->color);            
            }     
            $data['product']->views+=1;
            $data['product']->update(); 
            $product_click =  new ProductClick();
            $product_click->product_id = $data['product']->id;
            $product_click->date = Carbon::now()->format('Y-m-d');
            $product_click->save();           
            $data['product_meta'] = $data['product']->tags; 
            $vendor = User::where('id','=',$data['product']->user_id)->first();
            if(!empty($vendor))
            {
                $data['vendor'] = $vendor;
            }
            $similars = collect();
        
            if($data['product']->generic_name){
                $similars = Product::where('generic_name',$data['product']->generic_name)->where('status','=','1')->whereNotNull('sub_title')->with('combo_prices')->get();
            }
            $data['product']['similars'] = $similars;
            $data['success'] = true;
            return response()->json($data['product'],200);
            
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            $data['success'] = false;
            $data['message'] = 'Server Error';
            return response()->json($data,500);
        }
       
    }

    public function ChildCategory(Request $request,$slug)
    {
        $data= [];
        try{
            $data['sort'] = "";
            $data['childcat'] = Childcategory::where('child_slug','=',$slug)->first();
            $data['products'] = $data['childcat']->products()->where('status','=',1)->with('combo_prices')->orderBy('id','desc')->paginate(10);
            if(!empty($request->min) || !empty($request->max))
            {
                $data['min'] = $request->min;
                $data['max'] = $request->max;
                $data['products'] = $data['childcat']->products()->where('status','=',1)->whereBetween('cprice', [$data['min'],$data['max']])->with('combo_prices')->orderBy('cprice','asc')->paginate(10);
                $data['success'] = true;
                return response()->json($data,200);
            }
            $data['success'] = true;
            return response()->json($data,200);
        }catch (\Exception $e) {
            \Log::info($e->getMessage());
            $data['success'] = false;
            $data['message'] = 'Server Error';
            return response()->json($data,500);
        }
        
    }

    public function Search(Request $request,$search)
    {
        $data = [];
        try{
            $data['sort'] = "";
            $sproducts = Product::where('status','=',1)->where('name', 'like', '%' . $search . '%')->orWhere('company_name', 'like', '%' . $search . '%')->orWhere('tags', 'like', '%' . $search . '%')
            ->with('combo_prices')->orderBy('name')->take(20)->get();

            // dd($sproducts);
            // foreach($getproducts as $gp){
            //     $product = CategoryProduct::where('product_id','=',$gp->id)->where('category_id','!=',34)->get();
            //     foreach($product as $p){
            //         $dp = Product::where('id','=',$p->product_id)->with('combo_prices')->get();
            //         foreach($dp as $d){
            //             $sproducts[] = $d;
            //             // dd($sproducts->name);
            //         }
            //     }
            // }
            $data['sproducts'] =  $sproducts;
            // dd($data['sproducts'] =  $sproducts);
            $data['min'] = $request->min;
            $data['max'] = $request->max;
            if(!empty($request->min) || !empty($request->max)){
                $data['sproducts'] = Product::where('status','=',1)->where('name', 'like', '%' . $search . '%')->whereBetween('cprice', [$data['min'],$data['max']])->orderBy('cprice','asc')->orWhere('company_name', 'like', '%' . $search . '%')->orWhere('tags', 'like', '%' . $search . '%')
                ->with('combo_prices')->orderBy('name')->paginate(10);
            }
            $data['success'] = true;
            return response()->json($data,200);
        }catch (\Exception $e) {
            \Log::info($e->getMessage());
            $data['success'] = false;
            $data['message'] = 'Server Error';
            return response()->json($data,500);
        }
       
    }


    public function MedicineSearch(Request $request,$search)
    {
        $data = [];
        try{
            $data['sort'] = "";
            $getproducts = Product::where('status','=',1)->where('name', 'like', '%' . $search . '%')->orWhere('company_name', 'like', '%' . $search . '%')->orWhere('tags', 'like', '%' . $search . '%')
            ->with('combo_prices')->orderBy('name')->get();

            foreach($getproducts as $gp){
                $product = CategoryProduct::where('product_id','=',$gp->id)->where('category_id','=',34)->get();
                foreach($product as $p){
                    $dp = Product::where('id','=',$p->product_id)->with('combo_prices')->get();
                    foreach($dp as $d){
                        $mproducts[] = $d;
                        // dd($sproducts->name);
                    }
                }
            }
            $data['products'] =  $mproducts;
         
            $data['success'] = true;
            return response()->json($data,200);
        }catch (\Exception $e) {
            \Log::info($e->getMessage());
            $data['success'] = false;
            $data['message'] = 'Server Error';
            return response()->json($data,500);
        }
       
    }

    public function uploadPrescription(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'location' => 'required|string|max:191',
            'phone' => 'required',
            'filenames' => 'required|array|min:1',
            'filenames.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png,pdf',
        ]);

        $latlng = [
            'lat'=>floatval($request->latlong['lat']),
            'lng'=>floatval($request->latlong['lng']),
        ];

        $gs = Generalsetting::findOrFail(1);
        $user = $this->getUser($request->bearerToken());

        $prescription = new Prescription;
        $prescription->name = $request->name;
        $prescription->email = $request->email;
        $prescription->phone = $request->phone;
        $prescription->location = $request->location;
        $prescription->latlong = json_encode($latlng);
        $prescription->additional_info = $request->additional_info;
        $prescription->type = $request->type;
        $prescription->user_id = $user ? $user->id : null;
        
        $prescription->status = 'processing';
        $prescription->save();

        if($request->hasFile('filenames')){
            foreach ($request->filenames as $file){
                $filenameWithExt = $file->getClientOriginalName();
                $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);
    
                $filename = str_replace(' ','',$name).'_'.time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/prescriptions', $filename);
    
                
                $prescription_image = new Prescriptionfile;
                $prescription_image->file = $filename;
    
                $prescription_image->save();
    
                $pid = new PrescriptionfilePrescription;
            
                $pid->prescription_id = $prescription->id;
                $pid->prescriptionfile_id = $prescription_image->id;
                $pid->save();
            }
        }
            
        $notification = new Notification;
        $notification->prescription_id = $prescription->id;
        $notification->save();

        $data = [
            'to' => $request->email,
            'from' => 'info@merohealthcare.com',
            'subject' => 'Uploaded Prescription Successfully',
            'body' => "<b>Hello ".$request->name." </b> <br>"."<p>Your prescription has been successfully uploaded in our system and is currently under process. Your prescription has been successfully uploaded in our system and is currently under process. Our customer service representative will call you shortly on your given number which is ".$request->phone." and will address your need.</p>"
            ];
            $mailer = new GeniusMailer();
            $mailer->sendCustomMailDoctor($data);

        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => $gs->email,
                'subject' => "New Prescription Order Recieved!!",
                'body' => "<b>Hello Admin!</b><br>Your store has received a new prescription order. Please login to your panel to check.",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        }
        else
        {
            $to = $gs->email;
            $subject = "New Prescription Order Recieved!!";
            $msg = "Hello Admin!\nYour store has recieved a new prescription order. Please login to your panel to check. \nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            mail($to,$subject,$msg,$headers);
        }
        
        return response()->json(['message'=>'Prescription Uploaded Successfully'],200);
   
    }

}
