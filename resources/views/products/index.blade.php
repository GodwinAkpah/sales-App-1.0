@extends('layouts.app')

@section('content')
  <div class="container-fluid">
      <div class="col-lg-12">
          <div class="row">
                <div class="col-md-9">

                  <div class="card-header" style="height: 60px">
                    <h4 style="float:left">Add products</h4>
                    <a href="#" style="float: right " class="btn btn-dark" data-toggle="modal" data-target="#addproduct">
                    <i class="fa fa-plus"></i>Add new Products</a>
                  </div>
                  
                  <div class="card-body">
                      <table class="table table-bordered table-left">
                        <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Product Name</th>
                                  <th>Brand</th>
                                  <th>Price</th>
                                  <th>Qty</th>
                                {{-- <th>Phone</th> --}} 
                                  <th>Alert_stock</th>
                                  <th>Actions</th>
                              </tr>
                          </thead> 
                          <tbody>
                              @foreach ($products as $key => $product)
                                  <tr>
                                      <td>{{ $key+1 }}</td>
                                      <td>{{$product->product_name}}</td>
                                      <td>{{$product->brand}}</td>
                                      <td>{{ number_format($product->price,2)}}</td>
                                      <td>{{$product->quantity}}</td>
                                      <td>
                                        @if($product->alert_stock >= $product->quantity) 
                                        <span class="badge badge-danger"> Low stock > {{ $product->alert_stock }}</span>
                                        @else 
                                        <span class="badge badge-success">{{ $product->alert_stock }}</span> 
                                        @endif
                                    </td>

                                      
                                      <td>
                                      <div class="btn-group">
                                          <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editproduct{{ $product->id }}"><i class="fa fa-edit">Edit</i></a>
                                          <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteproduct{{ $product->id }}"><i class="fa fa-trash">Del</i></a>
                                        </div>
                                    </td>
                                  </tr>
                                  {{-- modal for edit --}}
                                  {{-- modal section --}}
                                  <div class="modal right fade" id="editproduct{{ $product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title" id="staticBackdropLabel">Edit product</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          {{ $product->id }}
                                        </div>
                                        <div class="modal-body">
                                          <form action="{{ route('products.update',$product->id)}}" method="post">
                                            @csrf
                                            @method('put')

                                            <div class="form-group">
                                                <label for=""> Product Name</label>
                                                <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Brand</label>
                                                <input type="text" name="brand" value="{{ $product->brand }}"  class="form-control">
                                              {{-- <select name="is_admin" id="" class="form-control">
                                                    <option value="1">Admin</option>
                                                    <option value="2">Cashier</option>
                                                </select> --}} 
                                            </div>
                                            <div class="form-group">
                                                <label for="">Price</label>
                                                <input type="number" name="price"  value="{{ $product->price }}"   class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Quantity</label>
                                                <input type="number" name="quantity" value="{{ $product->quantity}}"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Alert_Stock</label>
                                                <input type="number" name="alert_stock"  value="{{ $product->alert_stock}}"   class="form-control">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <textarea name="description" cols="30" rows="2" class="form-control">{{ $product->description}}</textarea>
                                                
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button class="btn btn-primary btn-block"> Update product</button>
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

                                  {{-- delete modal section --}}

                                  {{-- modal section --}}
                                  <div class="modal right fade" id="deleteproduct{{ $product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title" id="staticBackdropLabel">Delete product</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('products.destroy',$product->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <p>Are you sure you want to delete this {{ $product->product_name }} ?</p>
                                                  
                                                
                                                <div class="modal-footer">
                                                    <button class="btn btn-info" data-dismiss="modal">Cancel</button>
                                                    <button  type="submit" class="btn btn-danger">Delete</button>
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
                              @endforeach

                              {{$products ?? ''->links()}}
                          </tbody>
                      </table>
                  </div>
                              
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header"> <h4>Search product</h4></div>
                        <div class="card-body">

                          <form action="{{ route('autocomplete') }}" method="POST">
                          @csrf
                            
                            <div class="form-group">
                              <input type="text" class="form-control typeahead" placeholder="search products">
                            </div>
                          </form>
                            {{-- <table class="table table-bordered table-left">
                            </table> --}}
                        </div>
                    </div>
                </div>
                 
          </div>



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
                    <label for=""> Product Name</label>
                    <input type="text" name="product_name" class="form-control">
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
                    <input type="number" name="quantity" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Alert_Stock</label>
                    <input type="number" name="alert_stock" class="form-control">
                </div>
                
                
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" cols="30" rows="2"  class="form-control"></textarea>
                    
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
                    <input type="password" name="confirm_password" class="form-control">
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
          transform: translate3d(25%,0,0);

      }
  </style>



@endsection

 
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
  

@section('script')





 