@extends('layouts.main')

@section('content')

<style type="text/css">
      .add-product-laravel-form{
         border-radius: 5px;
         box-shadow: 0 0 6px 0px #cecbc0;
         box-sizing: border-box;
         padding:10px 0 10px 0;
      }
      .input-100::placeholder,.input-101::placeholder{
         color:black;
         font-weight:500;
         font-size:20px;
      }
      .fs18{
         font-size:18px;
      }
      .add-btn:hover{
         color:black;
         background-color:lightgreen;
         border:none;
      }
   </style>
   <div class="sub-container my-3 py-3">
      <form method="post" action="{{ route('edit') }}">
         @csrf
         <div class="d-flex flex-row flex-wrap justify-content-center add-product-laravel-form">
            <div class="col-lg-7 col-md-7 col-sm-12">
               <input type="hidden" name="hidden_parent" value="{{ $user['parent_id'] }}">
               <div class="form-group">
                  <label class="form-check-label my-2 fs18" for="product_name">Enter Name</label>
                  <input type="text" class="form-control w-100 input-100 @error('name') is-invalid @enderror" value="{{ $user['name'] }}" placeholder="Enter name" id="name" name="name"/>
               </div>
               @error('name')
                  <small class="text-danger"><strong>{{ $message }}</strong></small>
               @enderror
               <div class="form-group">
                  <label class="form-check-label my-2 fs18" for="email">Enter Email</label>
                  <input type="text" class="form-control w-100 input-101 @error('email') is-invalid @enderror" value="{{ $user['email']}}" placeholder="Enter Email" id="email" name="email"/>
               </div>
               @error('email')
                  <small class="text-danger"><strong>{{$message}}</strong></small>
               @enderror
               <div class="form-group">
                  <label class="form-check-label my-2 fs18" for="password">Enter New Password</label>
                  <input type="text" class="form-control w-100 input-101 @error('password') is-invalid @enderror" placeholder="Enter New Password" id="password" name="password"/>
               </div>
               @error('password')
                  <small class="text-danger"><strong>{{$message}}</strong></small>
               @enderror
               <div class="process-btn text-center my-2">
                  <button class="btn btn-success w-25 add-btn">Add</button>
               </div>
            </div>
         </div>
      </form>
   </div>

@endsection