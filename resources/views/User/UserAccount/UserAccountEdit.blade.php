@extends('User.Layouts.Master')

@section('title')
    <title> User Account Update </title>
@endsection

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <a href="{{ route('User#Home') }}" class="text-dark text-decoration-none"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 offset-lg-2 offset-md-2 offset-0 ">
                <div class="card mt-5" style="border-radius: 20px">
                    <div class="card-body" >
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Detail</h3>
                           <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-10 col-10 offset-2 ">
                                    <div class="pt-5 mt-4">
                                        @if (Auth::user()->image == null)
                                            <img src="{{asset('/Admin/images/default_image.jpg')}}"  class="w-100 rounded-circle"  alt="..."/>
                                        @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" class="w-100 rounded-circle"  alt="..."/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-11 col-11 offset-1">
                                    <form action="{{ route('User#AccountUpdate',Auth::user()->id)}}" method="post" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="form-group">
                                            <label> Name </label>
                                            <input type="text" name="name" value="{{old('name',Auth::user()->name)}}"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input type="text" name="email" value="{{old('email',Auth::user()->email)}}" disabled  class="form-control "  >
                                        </div>
                                        <div class="form-group">
                                            <label> Phone Number </label>
                                            <input type="text" name="phone_number" value="{{old('phone_number',Auth::user()->phone_number)}}"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label> Address </label>
                                            <input type="text" name="address" value="{{old('address',Auth::user()->address)}}"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label> Role </label>
                                            <input type="text" name="role" value="{{old('role',Auth::user()->role)}} "  disabled class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label> Profile picture </label>
                                            <input type="file" name="image"  id="" class="form-control" />
                                        </div>
                                        <div class="float-end">
                                            <input type="submit" value="Edit" class="btn bg-dark text-white" style="width:100px;" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
