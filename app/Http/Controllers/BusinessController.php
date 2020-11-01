<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\BusinessOrder;
use Illuminate\Support\Facades\Session;
use App\PrescriptionFile;
use App\Prescription;
use App\BusinessorderfileBusinessorder;
use App\Businessorderfile;
use App\User;
use Auth;

class BusinessController extends Controller
{
    public function requestQuote(Request $request)
    {
        $user = Auth::guard('user')->user();
        
        
        $product = Product::findOrFail($request->product_id);
        return view('front.uploadprescriptionbusiness', compact('product','user'));
    }


    public function store(Request $request)
    {


        // dd($request->filename[1]);
       // dd($request->filename);

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'phone' => 'required',
            'pan_vat' => 'required',
            'reg_no' => 'required',
            'company_name' => 'required',
            'quantity' => 'required',
            'filename' => 'required',
            'filename.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png,pdf',
            // 'reg_certificate_file' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png,pdf'
           
        ]);

        // dd($request);
       

        $business_order_image = new PrescriptionFile;

        $business_order = new BusinessOrder();
        $business_order->name = $request->name;
        $business_order->email = $request->email;
        $business_order->phone = $request->phone;
        $business_order->address = $request->address;
        $business_order->pan_vat = $request->pan_vat;

        $business_order->reg_no = $request->reg_no;
        $business_order->quantity = $request->quantity;
        $business_order->product_id = $request->product_id;
        $business_order->company_name = $request->company_name;
      
    
       
       

        $user_id = Auth::guard('user')->user();
        $business_order->user_id = $user_id->id;

        // dd($user_id->id);

        $business_order->status = 'processing';

        if($request->hasFile('reg_certificate_file')){
            $reg_certificate_file = $request->file('reg_certificate_file');

            $filenameWithExt = $reg_certificate_file->getClientOriginalName();
            $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
            $path = $reg_certificate_file->storeAs('public/businessorders', $filename);
            $business_order->reg_certificate_file = $filename;
        }
        
        $business_order->save();
        // dd($business_order);

        if($request->hasFile('filename')){
            foreach ($request->filename as $reg_certificate_file){


            $filenameWithExt = $reg_certificate_file->getClientOriginalName();
            $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
            $path = $reg_certificate_file->storeAs('public/businessorders', $filename);

            
            $businessorder_file = new Businessorderfile;
           
            $businessorder_file->user_id = $user_id->id;
        
            $businessorder_file->file = $filename;

            $businessorder_file->save();

            $bid = new BusinessorderfileBusinessorder;
            $bid->businessorder_id = $business_order->id;
            $bid->businessorderfile_id = $businessorder_file->id;
            $bid->save();
          
            }
        }

       

        return redirect()->to('/upload-business-prescription/success')->with('success','Thank you for your submission. Our Staff will soon be in touch with you.');
        

    }


    public function getBusinessorderFile($id, $filename, $bfid)
    {
        $businessorder = BusinessOrder::findOrFail($id);
        $bf = $businessorder->files()->findOrFail($bfid);
       

        try{
            $path = \Storage::get('public/businessorders/'.$bf->file);
            $mimetype = \Storage::mimeType('public/businessorders/'.$bf->file);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }


    // public function getBusinessorderFile($id, $filename,$pfid)


    // {
        
    //     $businessorder = Auth::guard('user')->user()->businessorders()->findOrFail($id);
      
    //     $pf= $businessorder->files()->findOrFail($pfid);
  
    //     try{
    //         $path = \Storage::get('public/businessorders/'.$pf->file);
            
    //         $mimetype = \Storage::mimeType('public/businessorders/'.$pf->file);

    //         return \Response::make($path, 200, ['Content-Type' => $mimetype]);
    //     }
    //     catch (\Exception $e) {
    //         abort(404);
    //     }
    // }

    
}
