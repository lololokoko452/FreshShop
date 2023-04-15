<?php

namespace App\Models;

class Cart{

    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;


    public function __construct($oldCart){

        if($oldCart){
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }

    }

    public function add(Product $item){

        $storedItem = ['qty' => 0, 'product_id' => 0, 'product_name' => $item->name,
            'product_price' => $item->price, 'product_image' => $item->imageName, 'item' =>$item];

        if($this->items){
            if(array_key_exists($item->id, $this->items)){
                $storedItem = $this->items[$item->id];
            }
        }

        $storedItem['qty']++;
        $storedItem['product_id'] = $item->id;
        $storedItem['product_name'] = $item->name;
        $storedItem['product_price'] = $item->price;
        $storedItem['product_image'] = $item->imageName;
        $this->totalQty++;
        $this->totalPrice += $item->price;
        $this->items[$item->id] = $storedItem;

    }

    //public function updateQty($id, $qty){
    //    $this->totalQty -= $this->items[$id]['qty'];
    //    $this->totalPrice -= $this->items[$id]['product_price'] * $this->items[$id]['qty'];
    //    $this->items[$id]['qty'] = $qty;
    //    $this->totalQty += $qty;
    //    $this->totalPrice += $this->items[$id]['product_price'] * $qty;
//
    //}
//
    //public function removeItem($id){
    //    $this->totalQty -= $this->items[$id]['qty'];
    //    $this->totalPrice -= $this->items[$id]['product_price'] * $this->items[$id]['qty'];
    //    unset($this->items[$id]);
    //}


}

?>
