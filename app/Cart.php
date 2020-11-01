<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Cart extends Model
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function total(){
        if ($this->items) {
            $total = 0;
            foreach ($this->items as $item) {
                $total += $item['price'];
            }
            return $total;
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

    public function getQty($id){
        if ($this->items) {
            $qty = 0;
            if (array_key_exists($id, $this->items)) {
                return $this->items[$id]['qty'];                
            }
        }
        return 0;
    }

    public function add($item, $id) {
        $storedItem = ['qty' => 0, 'size' => $item->size, 'color' => $item->color, 'stock' => $item->stock, 'price' => $item->price, 'item' => $item, 'license' => '', 'family' => []];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
                $storedItem['item'] = $item;
                $storedItem['stock'] = ($item->stock < $storedItem['qty'] ? 0 : ($item->stock - $storedItem['qty']));
            }
        }
        $storedItem['qty']++;
        if($item->stock !== null)
        {
            $storedItem['stock']--;            
        }

        if($item->size != null)
        { 
            $size = explode(',', $item->size);
            $storedItem['size'] = $size[0];
        }  
        if($item->color != null)
        { 
            $color = explode(',', $item->color);
            $storedItem['color'] = $color[0];
        } 
 
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice = $this->total();
    }

    public function adding($item, $id) {
        $storedItem = ['qty' => 0, 'size' => $item->size, 'color' => $item->color, 'stock' => $item->stock, 'price' => $item->price, 'item' => $item, 'license' => '', 'family' => []];
        
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
                $storedItem['item'] = $item;
                $storedItem['stock'] = ($item->stock < $storedItem['qty'] ? 0 : ($item->stock - $storedItem['qty']));
            }
        }
        
        $storedItem['qty']++;

        if($item->stock !== null)
        {
            $storedItem['stock']--;
        }

        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice = $this->total();
    }

    public function reduce($item, $id) {
        $storedItem = ['qty' => 0, 'size' => $item->size, 'color' => $item->color, 'stock' => $item->stock, 'price' => $item->price, 'item' => $item, 'license' => '', 'family' => []];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
                $storedItem['item'] = $item;
                $storedItem['stock'] = ($item->stock < $storedItem['qty'] ? 0 : ($item->stock - $storedItem['qty']));
            }
        }
        $storedItem['qty']--;
        if($item->stock !== null)
        {
            $storedItem['stock']++;
        }
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty--;
        $this->totalPrice = $this->total();
    }

    public function addnum($item, $id, $qty, $size, $color) {
        $storedItem = ['qty' => 0, 'size' => $item->size, 'color' => $item->color, 'stock' => $item->stock, 'price' => $item->price, 'item' => $item, 'license' => '', 'family' => []];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
                $storedItem['item'] = $item;
                $storedItem['stock'] = ($item->stock < $storedItem['qty'] ? 0 : ($item->stock - $storedItem['qty']));
            }
        }
        $storedItem['qty'] = $storedItem['qty'] + $qty;
        if($item->stock !== null)
        {
        $storedItem['stock'] -=  $qty;            
        }
        if($item->size != null)
        { 
        $sizes = explode(',', $item->size);
        $storedItem['size'] = $sizes[0];
        }  
        if(!empty($size)){
        $storedItem['size'] = $size;    
        }
        if($item->color != null)
        { 
        $colors = explode(',', $item->color);
        $storedItem['color'] = $colors[0];
        }  
        if(!empty($color)){
        $storedItem['color'] = $color;    
        }
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty+=$qty;
        $this->totalPrice = $this->total();
    }

    public function updateFamily($id, $family) {
        if (array_key_exists($id, $this->items)) {
            $this->items[$id]['family'] = $family;
        }
    }

    public function updateItem($item, $id,$size) {

        $this->items[$id]['size'] = $size;
    }

    public function updateLicense($id,$license) {

        $this->items[$id]['license'] = $license;
    }

    public function updateColor($item, $id,$color) {

        $this->items[$id]['color'] = $color;
    }

    public function removeItem($id) {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
