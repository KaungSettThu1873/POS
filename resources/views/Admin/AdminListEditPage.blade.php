@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Admin Lists Update </title>
@endsection

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-8 offset-2">
                <div class="card mt-5" style="border-radius: 20px">
                    <div class="card-body" >
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Detail</h3>
                           <div class="row">
                                <div class="col-4 offset-2 ">
                                    <div class="pt-5 mt-4">
                                        @if ($AdminEdit->image == null)
                                            <img src="{{asset('/Admin/images/default_image.jpg')}}"  class=" rounded-circle"  alt="..."/>
                                        @else
                                                <img src="{{asset('storage/'.$AdminEdit->image)}}" class=" rounded-circle"  alt="..."/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-5 offset-1">
                                    <form action="{{ route('Admin#ListEdit',$AdminEdit->id)}}" method="post" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="form-group">
                                            <label> Name </label>
                                            <input type="text" name="name" value="{{old('name',$AdminEdit->name)}}"  class="form-control">
                                            @error('name')
                                                <small class="text-danger" > {{ $message}} </small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label> Email </label>
                                            <input type="text" name="email" value="{{old('email',$AdminEdit->email)}}"   class="form-control "  >
                                        </div>
                                        <div class="form-group">
                                            <label> Phone Number </label>
                                            <input type="text" name="phone_number" value="{{old('phone_number',$AdminEdit->phone_number)}}"  class="form-control">
                                            @error('phone_number')
                                                <small class="text-danger" > {{ $message}} </small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label> Address </label>
                                            <input type="text" name="address" value="{{old('address',$AdminEdit->address)}}"  class="form-control">
                                            @error('address')
                                                <small class="text-danger" > {{ $message}} </small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label> Role </label>
                                            <input type="text" name="role" value="{{old('role',$AdminEdit->role)}} "   class="form-control">
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
