<?php

namespace App\Http\Livewire;
use App\Models\Product;
use App\Models\Cart; 
use App\Models\User;
use Auth;

use Livewire\Component;

class Order extends Component
{
    public $orders,
    $products=[],
    $prodoct_code,
    $message ='',
    $productIncart;
  public $pay_money='',
  $balance='';

    public function mount(){

        $this->products = Product::all();
        $this->productIncart = Cart::all(); 

    }

    public function IncrementQty($cartId){
     $carts= Cart::find($cartId); 
     $carts -> increment('product_qty', 1);
     $updatePrice= $carts-> product_qty * $carts->product->price;
     $carts->update(['product_price' => $updatePrice]);
     $this->mount();

    }


    public function DecrementQty($cartId){
        $carts= Cart::find($cartId); 
        if ($carts->product_qty == 1){
            return session()->flash('info',' Product ' . $carts->product->product_name. '  Quantity cannot be less than 1 add  quantity or remove product in cart.');
        }
        $carts -> decrement('product_qty', 1);
        $updatePrice= $carts-> product_qty * $carts->product->price;
        $carts->update(['product_price' => $updatePrice]);
         $this->mount();
        
    }
    public function InsertoCart(){

        $countProduct = Product::where('id',$this->prodoct_code)->first();

        if (!$countProduct){
            return $this->message = 'Product not found';
        }
        $countCartProduct = Cart::where('product_id',$this->prodoct_code)->count();
      
        if ($countCartProduct > 0){
            return $this->message ='Product'  .$countProduct->product_name . '  already exist';


        }
        $add_to_cart = new Cart;
        $add_to_cart->product_id = $countProduct->id;
        $add_to_cart->product_qty = 1;
        $add_to_cart->product_price = $countProduct->price;
        $add_to_cart-> user_id = auth()->user()->id;
        
        $add_to_cart->save();

        $this->productIncart->prepend($add_to_cart);

        $this->prodoct_code =' ';
        return $this->message ="product added successfully";



        // dd($countProduct);
    }
    public function removeProduct($cartId){
       $deleteCart= Cart::find($cartId);
       $deleteCart->delete();
       $this->message ="Product removed from cart";
       $this->productIncart= $this->productIncart->except($cartId);
    }

    public function render()
    {
        if($this->pay_money != ''){
            $totalAmount = $this->pay_money- $this->productIncart->sum('product_price');
            $this->balance = $totalAmount;
        }
       
        return view('livewire.order');
    }
}
