@extends('Admin.Category.Layouts.CategoryMaster')

@section('content')


        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div><a href="{{route('Admin#ProductsLists')}}" class=" text-decoration-none text-dark fs-5 "><i class="fa-solid fa-arrow-left text-dark me-2" ></i>Back</a></div>
                    <div class="col-lg-6 offset-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Products Create Form</h3>
                                </div>
                                <hr>
                                <form action="{{ route('Admin#ProductsCreate',)}}" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label  class="control-label mb-1 ">Products Name</label>
                                        <input  name='pizzaName' value="{{old('pizzaName')}}" type="text" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Pizza...">
                                    @error('pizzaName')
                                    <div  class="invalid-feedback" style="font-size:10px;">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1 d-block">Category</label>
                                        <select name="pizzaCategory"  value="{{ old('pizzaCategory')}}"  class="form-control @error('pizzaCategory') is-invalid @enderror">
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" > {{ $item->name}} </option>
                                            @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                        <div  class="invalid-feedback" style="font-size:10px;">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1 ">Description</label>
                                        <textarea name='pizzaDescription' rows="10"  class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Pizza information...">{{ old('pizzaDescription')}}</textarea>
                                        @error('pizzaDescription')
                                        <div  class="invalid-feedback" style="font-size:10px;">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>



                                    <div class="form-group">
                                        <label  class="control-label mb-1 ">image</label>
                                        <input  name='pizzaImage'  type="file" class="form-control @error('pizzaImage') is-invalid @enderror" aria-required="true" aria-invalid="false" >
                                        @error('pizzaImage')
                                        <div  class="invalid-feedback" style="font-size:10px;">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1 ">Waiting Time</label>
                                        <input  name='pizzaWaitingTime' value="{{old('pizzaWaitingTime')}}" type="number" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Waiting Time..." >
                                        @error('pizzaWaitingTime')
                                        <div  class="invalid-feedback" style="font-size:10px;">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label  class="control-label mb-1 ">Price</label>
                                        <input  name='pizzaPrice' value="{{old('pizzaPrice')}}" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Pizza Price...">
                                        @error('pizzaPrice')
                                        <div  class="invalid-feedback" style="font-size:10px;">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Create</span>
                                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                                            <i class="fa-solid fa-circle-right"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection



