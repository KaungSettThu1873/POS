@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Admin Account  </title>
@endsection

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <a href="{{ route('Admin#ListPage') }}" class="text-dark text-decoration-none"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
            <div class="col-lg-8 offset-2">
                <div class="card mt-5" style="border-radius: 20px">
                    <div class="card-body" >
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Detail</h3>
                           <div class="row">
                                <div class="col-4 offset-2 pt-2">
                                    @if (Auth::user()->image == null)
                                        <img src="{{asset('/Admin/images/default_image.jpg')}}"  class=" rounded-circle"  alt="..."/>
                                    @else
                                        <img src="{{asset('storage/'.Auth::user()->image)}}" class=" rounded-circle" alt="..."/>
                                    @endif

                                </div>
                                <div class="col-5 offset-1">
                                    <p class="fs-5 pt-5"> Name         - {{Auth::user()->name}} </p>
                                    <p class="fs-5 mt-2"> Email        - {{Auth::user()->email}} </p>
                                    <p class="fs-5 mt-2"> Phone Number - {{Auth::user()->phone_number}} </p>
                                    <p class="fs-5 mt-2"> Address      - {{Auth::user()->address}} </p>
                                    <p class="fs-5 mt-2"> Role         - {{Auth::user()->role}} </p>

                                </div>

                           </div>
                           <hr/>

                           <div class="float-end">
                              <a href="{{route('Admin#AccountUpdatePage')}}" class="btn bg-dark text-white" style="width:100px;" >Edit </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
