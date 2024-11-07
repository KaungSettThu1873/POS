{{-- @extends('User.Layouts.Master')

@section('title')
    <title> Account Detail </title>
@endsection


@section('content')

<div class="main-content">
    <div class="col-12">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <a href="{{ route('User#Home') }}" class="text-dark text-decoration-none"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
                <div class="col-lg-8 col-md-8 col-sm-10 col-10 offset-lg-2 offset-md-2 offset-sm-1 offset-1 ">
                    <div class="card mt-5" style="border-radius: 20px">
                        <div class="card-body " >
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Detail</h3>
                               <div class="row ">
                                    <div class="col-lg-4  col-md-4  col-sm-12 col-12 offset-lg-2 offset-md-2 offset-sm-0 offset-0 pt-2">
                                        @if (Auth::user()->image == null)
                                            <img src="{{asset('/Admin/images/default_image.jpg')}}"  class=" rounded-circle w-100"  alt="..."/>
                                        @else
                                            <img src="{{asset('storage/'.Auth::user()->image)}}" class=" rounded-circle w-100" alt="..."/>
                                        @endif
                                    </div>
                                    <div class="col-lg-5 col-md-5  col-sm-12  col-12 offset-lg-1 offset-md-1 offset-sm-0 offset-0">
                                        <p class="fs-5 pt-5"> Name         - {{Auth::user()->name}} </p>
                                        <p class="fs-5 mt-2"> Email        - {{Auth::user()->email}} </p>
                                        <p class="fs-5 mt-2"> Phone Number - {{Auth::user()->phone_number}} </p>
                                        <p class="fs-5 mt-2"> Address      - {{Auth::user()->address}} </p>
                                        <p class="fs-5 mt-2"> Role         - {{Auth::user()->role}} </p>

                                    </div>

                               </div>
                               <hr/>

                               <div class="float-end ">
                                  <a href="{{route('User#AccountEdit')}}" class="btn bg-dark text-white" style="width:100px;" >Edit </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection --}}


