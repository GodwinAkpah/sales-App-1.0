<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable=['product_name','price','alert_stock','quantity','brand','description'];


    public function orderdetail()
    {
        //return $this->hasMany('App\Order_detail');
        return $this->hasMany(Order_detail::class);
    }


    public function cart()
    {
        //return $this->hasMany('App\Order_detail');
        return $this->hasMany(Cart::class);
    }
}
