@extends('layouts.main')

@section('content')
<style>
    .sub-container{
        top:30%;
        transform: translateY(50%);
    }
    
    .form-control.is-invalid:focus{
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25) !important;
    }
</style>
    <div class="row justify-content-center sub-container">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    SIGNUP
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="name">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" autofocus/>
                        </div>
                        @error('name')
                            <small class="text-center"><strong class="text-danger">{{ $message }}</strong></small>
                        @enderror
                        <div class="form-group">
                            <label class="control-label" for="email">Username</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="email" autofocus/>
                        </div>
                        @error('email')
                            <small class="text-center"><strong class="text-danger">{{ $message }}</strong></small>
                        @enderror
                        <div class="form-group">
                            <label class="control-label" for="password">Password</lable>
                            <input type="password" name="password" class="form-control w-100 @error('password') is-invalid @enderror"  id="password" autofocus>
                        </div>
                        @error('password')
                            <small class="text-center"><strong class="text-danger">{{ $message }}</strong></small>
                        @enderror
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-outline-dark">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection