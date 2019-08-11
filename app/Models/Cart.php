<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items=null;
    public $totalQuantity = 0;
    public $totalPrice = 0;
    public function __construct($oldCart) {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }
    
    public function add($item, $id) {
        $storedItem = ['quantity' => 0, 'price' => $item->price, 'item' => $item];
        if($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }

        $storedItem['quantity']++;
        $storedItem['price'] = $item->price * $storedItem['quantity'];
        $this->items[$id] = $storedItem;
        $this->totalQuantity++;
        $this->totalPrice += $item->price;
    }

    public function deleteCartItem($item, $id) {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
                $this->totalQuantity -= $storedItem['quantity'];
                $this->totalPrice -= $storedItem['price'];
                unset($this->items[$id]);
                return true;
            }
            return false;
        }
    }

    public function upQuantity($item, $id) {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
                $storedItem['quantity']++;
                $storedItem['price'] = $item->price * $storedItem['quantity'];
                $this->items[$id] = $storedItem;
                $this->totalQuantity += $item->quantity;
                $this->totalPrice += $item->price;
                return true;
            }
            return false;
        }
    }

    public function downQuantity($item, $id) {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
                $storedItem['quantity']--;
                $storedItem['price'] = $item->price * $storedItem['quantity'];
                $this->items[$id] = $storedItem;
                $this->totalQuantity -= $item->quantity;
                $this->totalPrice -= $item->price;
                return true;
            }
            return false;
        }
    }
}
