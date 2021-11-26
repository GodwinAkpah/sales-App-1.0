<div class="col-lg-12">
    <div class="row">
         <div class="col-md-8">

            <div class="card">

            
              {{-- @livewire('order') --}}
            
          
          <div class="card-header" style="height: 60px">
              <h4 style="float:left">Order Products</h4>
              <a href="#" style="float: right " class="btn btn-dark" data-toggle="modal" data-target="#addproduct">
                  <i class="fa fa-plus"></i>Add new Products</a>
                </div>
               
 
                  {{-- <form action="{{ route('orders.store') }}" method="post">
                      @csrf --}}
                  <div class="card-body">
                    <div class="my-2">
                       <form wire:submit.prevent="InsertoCart">
                        <input type="text"  wire:model="prodoct_code" class="form-control" placeholder="Enter Product code">
                    </form>
                    </div>
                      <div class="alert alert-success">{{ $message }}</div>
                    {{-- {{ $productIncart }} --}}

                    @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @elseif(session()->has('info'))
                     <div class ="alert alert-info">
                         {{ session('info') }}

                     </div>
                     @elseif (session()->has('error'))
                     <div class="alert alert-danger">
                         {{ session('error') }}

                     </div>
                     @endif


                     

                      <table class="table table-bordered table-left">
                           <thead>
                                <tr>
                                    <th></th>
                                    <th>ProductName</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Dis(%)</th>
                                   {{-- <th>Phone</th> --}} 
                                    <th colspan="6">Total</th>
                                    {{-- <th><a href="#" class="btn btn-sm btn-success add_more rounded-circle" ><i class="fa fa-plus"></i></a></th>
                                     --}}
                                </tr>
                            </thead> 
                             <tbody class="addMoreProduct">
                                    @foreach ($productIncart as $key=>$cart)    
                                       <tr>
                                          <td class="no">{{ $key+1 }}</td>
                                    
                                            <td width="30%">  
                                                <input type="text"  class="form-control"  value="{{ $cart->product->product_name }}">            
                                           </td>
                                                    <td width="15%">
                                                       <div class="row">
                                                         <div class="col-md-2">
                                                            <button wire:click.prevent="IncrementQty({{ $cart->id }})" class="btn btn-sm btn-success"> +</button>
                                                         </div>
                                                        <div class="col-md-1">
                                                          <label for="">{{ $cart->product_qty }}</label>

                                                       </div>
                                                       <div class="col-md-2">
                                                       <button  wire:click.prevent="DecrementQty({{ $cart->id }})"   class="btn btn-sm btn-danger"> - </button>
                                                      </div>
                                                     </div>         

                                          
                                                  </td>
                                               <td>
                                                 <input type="number" class="form-control" value="{{ $cart->product->price }}">
                                               </td>
                                               <td>
                                                  <input type="number" class="form-control">
                                              </td>
                                               <td>
                                                   <input type="number"   class="form-control total_amount" value="{{ $cart->product_qty * $cart->product->price }}">
                                               </td>
                                                  <td><a href="#" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times " wire:click="removeProduct({{ $cart->id }})"></i></a></td>
                                            </tr>
                                            </tr>
                                            </tr>
                                            </tr>
                                @endforeach
                            </tbody>         
                       </table>
                    </div>
         </div>
</div>

   




          <div class="col-md-4">
              <div class="card">
                  <div class="card-header"> 
                      <h4>Total  <b class="total1">{{ $productIncart->sum('product_price') }}</b></h4>
                  </div>


                  <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                     @foreach ($productIncart as $key=> $cart)    
                         <input type="hidden"  class="form-control" name="product_id[]"  value="{{ $cart->product->id }}" >                   
                         
                         <input type="hidden" name="quantity[]" value="{{ $cart->product_qty }}">
                     
                         
                         <input type="hidden" name="price[]"   class="form-control price" value="{{ $cart->product->price }}">
                         <input type="hidden" name="discount[]" class="form-control discount"  >
                         <input type="hidden" name="total_amount[]"   class="form-control total_amount" value="{{ $cart->product_qty * $cart->product->price }}">
                        
                                                 
                     @endforeach
                  <div class="card-body">
                      <div class="btn-group ">
                          <button type="button"   onclick="PrintReceiptContent('print')" class="btn btn-dark mr-3"> <i class="fa fa-print"></i>  Print</button>
                          <button type="button"  onclick="PrintReceiptContent('print')" class="btn btn-primary mr-3"> <i class="fa fa-print"></i>  History</button>
                          <button type="button"  onclick="PrintReceiptContent('print')" class="btn btn-danger"> <i class="fa fa-print"></i>Report</button>
                      </div>
                      <div class="panel">
                          <div class="row">

                              <table class="table table-striped">
                                  <tr>
                                      <td>
                                          <label for="">Customer Name</label>
                                          
                                              <input type="text" name="customer_name" id="" class="form-control">
                                          
                                      </td>
                                      <td>
                                          <label for="">Customer Phone</label>                                               
                                              <input type="number" name="customer_phone" id="" class="form-control">
                                          
                                      </td>
                                  </tr>

                              </table>
                              <td>Payment Method   
                                  

                                  <span class="radio-item">
                                      <input type="radio" name="payment_method" id="payment_method" 
                                      class="true" value="cash" >
                                      <label for="payment_method"><i class="fa fa-money-bill text-success"></i> Cash</label>
                                  </span>
                                  
                                <span class="radio-item">
                                      <input type="radio" name="payment_method" id="payment_method" 
                                      class="true" value="bank transfer">
                                      <label for="payment_method"><i class="fa fa-university text-danger"></i> Bank Transfer</label>
                                  </span>
                                  <span class="radio-item">
                                      <input type="radio" name="payment_method" id="payment_method" 
                                      class="true" value="credit card" >
                                      <label for="payment_method"><i class="fa fa-credit-card text-info"></i> Credit Card</label>
                                  </span>
                              </td><br>
                               

                                  <td>Payment
                                   <input type="number" wire:model="pay_money" name="paid_amount" id="paid_amount" class="form-control">
                                  </td>

                                  <td>
                                      Returning Change
                                      <input type="number" wire:model="balance"  readonly name="balance" id="balance" class="form-control">
                                  </td>
                                  <td>
                                      <button class="btn-primary  btn-lg btn-block mt-3">Save</button>
                                  </td>
                                  <td>
                                      <button class="btn-danger btn-lg btn-block mt-1">Calculator</button>
                                  </td>
                                  <div class="text-center">
                                      <a href="#" class="text-danger text"><i class="fa fa-sign-out"></i></a>
                                  </div>
                                </form>
                        </div>

                      </div>
                      
                  </div>
              </div>
          </div>
           
    </div>

{{-- - --}}}
  </form>
  </div>
    

</div>

</div>


{{-- modal section --}}
<div class="modal right fade" id="addproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title" id="staticBackdropLabel">Add product</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
      <form action="{{ route('products.store')}}" method="post">
          @csrf
          <div class="form-group">
              <label for=""> ProductName</label>
              <input type="text" name="product_name"  class="form-control">
          </div>

          <div class="form-group">
              <label for="">Brand</label>
              <input type="text" name="brand" class="form-control">
             {{-- <select name="is_admin" id="" class="form-control">
                  <option value="1">Admin</option>
                  <option value="2">Cashier</option>
              </select> --}} 
          </div>
          <div class="form-group">
              <label for="">Price</label>
              <input type="number" name="price"  class="form-control">
          </div>
          <div class="form-group">
              <label for="">Quantity</label>
              <input type="number" name="quantity"  class="form-control">
          </div>
          <div class="form-group">
              <label for="">Alert_Stock</label>
              <input type="number" name="alert_stock" class="form-control">
          </div>
          
          
          <div class="form-group">
              <label for="">Description</label>
              <textarea name="description" id="" cols="30" rows="2"  class="form-control"></textarea>
              
          </div>
          
          <div class="modal-footer">
              <button class="btn btn-primary btn-block">Save product</button>
          </div>
      
      </form>
    
  </div>
 {{--  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Understood</button>
  </div>--}} 
</div>
</div>
</div>


{{-- modal for edit --}}
{{-- modal section --}}
<div class="modal right fade" id="editproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title" id="staticBackdropLabel">Edit product</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
      <form action="{{ route('products.update',1)}}" method="post">
          @csrf
          <div class="form-group">
              <label for="">Name</label>
              <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Email</label>
              <input type="email" name="email"  class="form-control">
          </div>
          <div class="form-group">
              <label for="">Phone</label>
              <input type="text" name="phone" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Password</label>
              <input type="password" name="password" class="form-control">
          </div>
          <div class="form-group">
              <label for="">Confirm Password</label>
              <input type="password" name="confirm_password"  class="form-control">
          </div>
          <div class="form-group">
              <label for="">Role</label>
              <select name="is_admin"  class="form-control">
                  <option value="1">Admin</option>
                  <option value="2">Cashier</option>
              </select>
          </div>
          <div class="modal-footer">
              <button class="btn btn-primary btn-block">Save product</button>
          </div>
      
      </form>
    
  </div>
 {{--  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Understood</button>
  </div>--}} 
</div>
</div>
</div>

<style>
    .modal.right .modal-dialog{
        
        top: 0;
        right:0;
        margin-right:19vh;
    
    }
    
    .modal.fade:not(.in).right .modal-dialog{
        -webkit-transform: translate3d(25%,0,0);
        transform: translate3d(25%, , 0,0);
    
    }
    .radio-item input[type="radio"]{
       /* visibility:hidden;*/
        width:20px;
        height:20px;
        margin:  0 15px 0 15px;
        padding:0;
        cursor: pointer;
    
    }
    
    /* before style*/
    .radio-item input[type="radio"]:before{
        position:relative;
      margin:4px -25px -4px 0; 
        display: inline-block;
        visibility: visible;
        width: 20px;
        height: 20px;
        border-radius:10px;
       
        border: 2px inset rgb(150,150,150,0.75);
        background: radial-gradient(ellipse at top left, rgb(255,255.255)0%, rgb(250, 250, 250) 5%,rgb(230,230,230) 95%, rgb(225,225,225) 100%);
        content: '';
        cursor:pointer;     
       }
    
    
       /*  checked after style*/
       .radio-item input[type="radio"]:checked:after{
        position:relative;
        top: 0;
        left:9px;
        display: inline-block;
        visibility: visible;
        width: 12px;
        height: 12px;
    
        background: radial-gradient(ellipse at top left, rgb(240,255,220) 0%, rgb(225, 250, 100) 5%,rgb(75,75,0) 95%, rgb(25,100,0) 100%);
        content: '';
        cursor:pointer;     
           
       }
    
    
       
       
       
       /* after check*/
    
       .radio-item input[type="radio"].true:checked:after{
          background: radial-gradient(ellipse at top left, rgb(240,255,220) 0%, rgb(225, 250, 100) 5%,rgb(75,75,0) 95%, rgb(25,100,0) 100%);
       }
       .radio-item input[type="radio"].false:checked:after{
          background: radial-gradient(ellipse at top left, rgb(255,255,255)0%, rgb(250, 250, 250) 5%,rgb(230,230,230) 95%, rgb(225,225,225) 100%);
       }
    
    
       .radio-item label{
           display:inline-block;
           margin:0;
           padding: 0;
           line-height:25px;
           height: 25px;
           cursor: pointer;
    
       }
    
    
       
</style>


