<?php

namespace Modules\Lab\Http\Controllers;

use Modules\Lab\Entities\LabOrder as Order;
use Modules\Lab\Entities\LabOrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserOrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('user_id',Auth::guard('user')->user()->id)->orderBy('id','desc')->get();
        return view('lab::customer.order.index',compact('orders'));
    }
    
    public function show($id)
    {
        $order = Order::where('user_id',Auth::guard('user')->user()->id)->findOrFail($id);
        $items = $order->items;
        return view('lab::customer.order.details',compact('order','items'));
    }

    public function invoice($id)
    {
        $order = Order::where('user_id',Auth::guard('user')->user()->id)->findOrFail($id);
        $items = $order->items;
        return view('lab::customer.order.invoice',compact('order','items'));
    }

    public function printpage($id)
    {
        $order = Order::where('user_id',Auth::guard('user')->user()->id)->findOrFail($id);
        $items = $order->items;
        return view('lab::customer.order.print',compact('order','items'));
    }

    public function getReportFile($id, $filename)
    {
        $item = LabOrderItem::findOrFail($id);

        if($item->order->user_id != Auth::guard('user')->user()->id) abort(403);

        try{
            $path = \Storage::get('public/labreports/'.$item->report_file);
            $mimetype = \Storage::mimeType('public/labreports/'.$item->report_file);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

}
