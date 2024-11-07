@extends('User.Layouts.Master')

@section('title')
    <title> Contact </title>
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content container-fluid">
       <div class="col-12">
        <div class="section__content section__content--p30">
            <div class="container-fluid ">


                <div class="col-md-12">
                    @if (session('Success'))
                    <div class="alert alert-success alert-dismissible fade show  mt-4 col-lg-8 offset-2" style="height: 50px;" role="alert">
                        <strong>{{session('Success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                     @endif

                        <div class="col-lg-8 col-md-10 col-sm-12 col-12 offset-lg-2 bg-white rounded rounded-4 shadow-lg">

                            <h4 class="text-dark text-center fw-bold pt-3">Customer Service</h4>
                            <div>
                                <form class="pt-4" action="{{ route('Contact#Admin') }}" method="POST">
                                    @csrf
                                    <div class="col-lg-6 col-md-8 col-sm-11 col-11 offset-lg-3  pb-4 ">
                                        <label class="d-block pb-2 fw-bold">Name</label>
                                        <input type="text" name="contactName" value="{{old('contactName',request('contactName'))}}"  id="" class=" form-control  @error('contactName')
                                            is-invalid
                                        @enderror"
                                            placeholder="Enter Your Name" />
                                        @error('contactName')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-8 col-sm-11 col-11 offset-lg-3  pb-4">
                                        <label class="d-block pb-2 fw-bold">Email</label>
                                        <input type="email" name="contactEmail" id="" value="{{old('contactEmail',request('contactEmail'))}}" class="form-control  @error('contactEmail')
                                            is-invalid
                                        @enderror " placeholder="Enter Your Email" />
                                        @error('contactEmail')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-8 col-sm-11 col-11 offset-lg-3 pb-4">
                                        <label class="d-block pb-2 fw-bold">Message</label>
                                        <textarea class="form-control   @error('contactMessage')
                                            is-invalid
                                        @enderror " name="contactMessage" rows="12" placeholder="Enter Your Message">{{old('contactMessage',request('contactMessage'))}}</textarea>
                                        @error('contactMessage')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-8 col-sm-11 col-11 offset-lg-3  text-end pb-3 ">
                                        <button class="btn btn-dark text-white" type="submit" id="BtnSend">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                </div>
            </div>
        </div>
       </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

{{-- @section('ScriptSource')
       <script>
         $(document).ready(function(){
                $('#BtnSend').click(function(){
                    alert('We will contact in 10 minutes');
                })
         })
       </script>
@endsection --}}
