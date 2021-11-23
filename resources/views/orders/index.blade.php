@extends('layouts.app')

@section('content')

{{-- <section style="padding-top: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Search Products
                    </div>
                    <div class="card-body" style="padding-top:30px; padding-bottom:40px;padding-left:20px;padding-right:20px;">
                        <form>

                            <div class="form-group">
                                <input type="text" class="form-control typeahead" placeholder="search...">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section> --}}
  <div class="container-fluid">
      <div class="col-lg-12">
          <div class="row">
               <div class="col-md-8">

                <div class="card-header" style="height: 60px">
                    <h4 style="float:left">Order Products</h4>
                    <a href="#" style="float: right " class="btn btn-dark" data-toggle="modal" data-target="#addproduct">
                        <i class="fa fa-plus"></i>Add new Products</a></div>


                        <form action="{{ route('orders.store') }}" method="post">
                            @csrf
                <div class="card-body">
                      <table class="table table-bordered table-left">
                                 <thead>
                                      <tr>
                                          <th></th>
                                          <th>ProductName</th>
                                          <th>Quantity</th>
                                          <th>Price</th>
                                          <th>Dis(%)</th>
                                         {{-- <th>Phone</th> --}} 
                                          <th>Total</th>
                                          <th><a href="#" class="btn btn-sm btn-success add_more rounded-circle" ><i class="fa fa-plus"></i></a></th>
                                          
                                      </tr>
                                  </thead> 
                                   <tbody class="addMoreProduct">
                                      <tr>
                                          <td>1</td>
                                          <td>
                                              <select name="product_id[]" id="product_id" class="form-control product_id">
                                                  <option value="">select Item</option>
                                                    @foreach ($products as $product)
                                                    <option  data-price="{{ $product->price }}"
                                                     value="{{ $product->id }}">
                                                     {{ $product->product_name }}
                                                    </option>
                                                        
                                                        
                                                    @endforeach
                                            </select>
                                          </td>
                                            <td>
                                                <input type="number" name="quantity[]" id="quantity"  class="form-control quantity">
                                            </td>
                                            <td>
                                                <input type="number" name="price[]" id="price"  class="form-control price">
                                            </td>
                                            <td>
                                                <input type="number" name="discount[]" id="discount"  class="form-control discount">
                                            </td>
                                            <td>
                                                <input type="number" name="total_amount[]" id="total_amount"  class="form-control total_amount">
                                            </td>
                                            <td><a href="#" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times "></i></a></td>
                                      </tr>
                                      </tr>
                                      </tr>
                                      </tr>
                                  </tbody>         
                      </table>
                </div>
            </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> 
                            <h4>Total 0.00  <b class="total">0.00</b></h4>
                        </div>
                        <div class="card-body">
                            <div class="btn-group">
                                <button type="button"  onclick="PrintReceiptContent('print')" class="btn btn-dark"> <i class="fa fa-print"></i>  Print</button>
                                <button type="button"  onclick="PrintReceiptContent('print')" class="btn btn-primary"> <i class="fa fa-print"></i>  History</button>
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
                                         <input type="number" name="paid_amount" id="paid_amount" class="form-control">
                                        </td>

                                        <td>
                                            Returning Change
                                            <input type="number" readonly name="balance" id="balance" class="form-control">
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

<div class="modal">
    <div id="print">
        @include('reports.receipt')
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
@endsection


@section('script')
<script>
//  $(document).ready(function(){
//         alert(1);
//     })
$('.add_more').on('click',function(){
    var product= $('.product_id').html();
    var numberofrow= ($('.addMoreProduct tr').length - 0) + 1;
    var tr = '<tr><td class"no"">' + numberofrow +'</td>'+
            '<td><select class="form-control product_id" name="product_id[]" >' + product +
            '</select></td>'+
            '<td> <input type = "number" name="quantity[]" class= "form-control quantity"></td>'+
            '<td> <input type = "number" name="price[]" class= "form-control price"></td>'+
            '<td> <input type = "number" name="discount[]" class= "form-control discount"></td>'+
            '<td> <input type = "number" name="total_amount[]" class= "form-control total_amount"></td>'+
            '<td> <a class="btn btn-danger btn-sm delete rounded-circle"><i  class ="fa fa-times-circle"></a></td>';
    $('.addMoreProduct').append(tr);
});

//delete a row
 $('.addMoreProduct').delegate('.delete','click',function(){

    $(this).parent().parent().remove();
});

function TotalAmount(){
    //logic
    var total= 0;
    $('.total_amount').each(function(i, e){
        var amount=$(this).val() - 0;
        total += amount;
    });

    $('.total').html(total);

}


$('.addMoreProduct').delegate('.product_id', 'change',function(){
    var tr= $(this).parent().parent();
    var price= tr.find('.product_id option:selected').attr('data-price');
    tr.find('.price').val(price);
    var qty = tr.find('.quantity').val() - 0;
    var disc = tr.find('.discount').val() - 0;
    var price = tr.find('.price').val() - 0;
    var total_amount = (qty * price)-((qty * price * disc) / 100);
    tr.find('.total_amount').val(total_amount);
    TotalAmount();
});
$('.addMoreProduct').delegate('.quantity, .discount', 'keyup', function(){
    var tr = $(this).parent().parent();
    var qty= tr.find('.quantity').val() - 0;
    var disc= tr.find('.discount').val() - 0;
    var price= tr.find('.price').val() - 0;
    var total_amount = (qty * price) - (( qty * price * disc) / 100);
    tr.find('.total_amount').val(total_amount);
    TotalAmount();
})
$('#paid_amount').keyup(function(){
    //alert(1)
    var total= $('.total').html();
    var paid_amount= $(this).val();
    var tot =paid_amount - total;
    $('#balance').val(tot).toFixed(2);

})

//print section
function PrintReceiptContent(el){
    var data=
    '<input type="button" id="printPageButton class="printPageButton" style="display: block; width: 100%; border: none; background-color: #008B8B; color: #fff; padding:14px 28px; font-size:16px; cursor:pointer; text-align: center" value="Print Receipt" onClick="window.print()">';
              
             
             
              
              
        data+= document.getElementById(el).innerHTML;
        myReceipt=window.open("","myWin","left=150, top=130, width=400, height=400");
           myReceipt.screnX=0;
           myReceipt.screnY=0;
           myReceipt.document.write(data);
           myReceipt.document.title="Print Receipt";
           myReceipt.focus();
           setTimeout(() => {
            myReceipt.close();
           }, 8000);


}

// var path="{{route('orders.index')}}";

// $('input.typeahead').typeahead({
//     source:function(terms,process){
//         return $.get(path,{terms:terms},function(data){
//             return process(data);
//         });

//     }
// });





</script>





{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script> --}}





@endsection


