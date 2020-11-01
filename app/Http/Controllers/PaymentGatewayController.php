<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentGateway;
use App\Currency;

class PaymentGatewayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $sign = Currency::where('is_default','=',1)->first();
        $payments = PaymentGateway::orderBy('id','desc')->get();
        return view('admin.payment.index',compact('payments','sign'));
    }


    public function create()
    {
        return view('admin.payment.create');
    }

  public function status($id1,$id2)
    {
        $payment = PaymentGateway::findOrFail($id1);
        $payment->status = $id2;
        $payment->update();
        return redirect()->route('admin-payment-index')->with('success','Status Updated Successfully.');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'discount_type' => 'required_if:discountCheck,1|nullable|in:1,0',
            'discount_value' => 'required_if:discountCheck,1|nullable|numeric|min:1',
            'min_purchase_amount' => 'nullable|numeric|min:1'
        ],[
            'discount_type.in' => 'Discount type can only be either Percentage or Amount'
        ]);

        $payment = new PaymentGateway();
        $data = $request->all();

        if(!$request->discountCheck){
            $data['discount_type'] = null;
            $data['discount_value'] = null;
            $data['min_purchase_amount'] = null;
        }

        $payment->fill($data)->save();
        return redirect()->route('admin-payment-index')->with('success','New Data Added Successfully.');
    }

    public function edit($id)
    {
        $payment = PaymentGateway::findOrFail($id);
        return view('admin.payment.edit',compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'discount_type' => 'required_if:discountCheck,1|nullable|in:1,0',
            'discount_value' => 'required_if:discountCheck,1|nullable|numeric|min:1',
            'min_purchase_amount' => 'nullable|numeric|min:1'
        ],[
            'discount_type.in' => 'Discount type can only be either Percentage or Amount'
        ]);

        $payment = PaymentGateway::findOrFail($id);
        $data = $request->all();

        if(!$request->discountCheck){
            $data['discount_type'] = null;
            $data['discount_value'] = null;
            $data['min_purchase_amount'] = null;
        }

        $payment->update($data);
        return redirect()->route('admin-payment-index')->with('success','Data Updated Successfully.');
    }


    public function destroy($id)
    {
        $payment = PaymentGateway::findOrFail($id);
        $payment->delete();
        return redirect()->route('admin-payment-index')->with('success','Data Deleted Successfully.');
    }
}
