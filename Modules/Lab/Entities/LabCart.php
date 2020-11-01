<?php

namespace Modules\Lab\Entities;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\GeneralSetting;

class LabCart extends Model
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $vendor_id = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
            $this->vendor_id = $oldCart->vendor_id;
        }
    }

    public function total(){
        $gs = GeneralSetting::findOrFail(1);
        if ($this->items) {
            $total = 0;
            foreach ($this->items as $item) {
                $total += $item['price'];
            }
            return $total * (1+($gs->lab_vat/100));
        }
        return 0;
    }

    public function total_with_discount(){
        $total = $this->total();

        $gateway = Session::get('gateway');
        $gateway_discount = $gateway ? $gateway->discount : 0; 

        $coupon = Session::get('already');
        $coupon_discount = $coupon ? $coupon->discount : 0; 

        $total = $total - $gateway_discount - $coupon_discount;
        return $total > 0 ? $total : 0;
    }

    public function exists($id){
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                return true;
            }
        }
        return false;
    }

    public function add($item, $id) {
        $storedItem = ['price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                return;
            }
        }
    
        $storedItem['price'] = $item->price;
        $this->items[$id] = $storedItem;
        $this->vendor_id = $item->user_id;
        $this->totalQty++;
        $this->totalPrice = $this->total();
    }

    public function removeItem($id) {
        if (!array_key_exists($id, $this->items)) {
            return;
        }
        $this->totalQty -= 1;
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
