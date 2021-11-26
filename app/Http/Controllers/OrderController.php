<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Transaction;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products= Product::all();
        $orders=Order::all();

    //last order details
    $lastID= order_Detail::max('order_id');
    $order_receipt=order_Detail::where('order_id',$lastID)->get();

        return view('orders.index',
        ['products'=>$products,
         'orders'=> $orders,
         'order_receipt'=>$order_receipt ]);
        
        


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    //   return $request->all();
        DB::transaction(function () use($request) {
            
      

        //order modal
        $orders= new Order;
        $orders->name = $request->customer_name;
        $orders->phone = $request->customer_phone;
        $orders->save();
        $order_id = $orders->id;
        //order details modal

        for($product_id=0; $product_id <  count($request->product_id); $product_id++){

            $order_details= new Order_detail; 
            $order_details->order_id =$order_id;
            $order_details->product_id=$request->product_id[$product_id ];
            $order_details->unitprice=$request->price[$product_id ];
            $order_details->quantity=$request->quantity[$product_id ];
            $order_details->discount=$request->discount[$product_id ];
            $order_details->amount=$request->total_amount[$product_id ];
            $order_details->save();
             
        }
       

        //transaction modal


        $transaction=new Transaction(); 
        $transaction->order_id =$order_id;
        $transaction->user_id= auth()->user()->id;

        $transaction->balance=$request->balance;
        $transaction->paid_amount=$request->paid_amount;
        $transaction->payment_method=$request->payment_method;
        $transaction->transaction_amount=$order_details->amount;
        $transaction->transaction_date=date('Y-m-d');
         $transaction->save();

         Cart::where('user_id',auth()->user()->id)->delete();
          //last order history

        $products=Product::all();
        $order_details=order_Detail::where('order_id',$order_id)->get();

    $orderedBy=order::where('id',$order_id)->get();
    return view('orders.index',[

        'products'=>$products,
        'order_details'=> $order_details,
        'customer_orders'=> $orderedBy
    ]);
        }); 

        return back()->with("product orders fails to be inserted! check your inputs!");
        
       


        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }


    
   
}