<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    
    protected $table ='order_details';
    protected $fillable =[
        'order_id','product_id','unitprice','quantity','amount','discount'

    ]; 

    /**
     * Get all of the comments for the Order_detail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   

    public function product()
    {
        // return $this->belongsTo('App\Product');
        return $this->belongsTo(Product::class);

    }
    public function order()
    {
       // return $this->belongsTo('App\Order');
       return $this->belongsTo(Order::class);
    }
}
