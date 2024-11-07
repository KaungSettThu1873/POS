@extends('Admin.Category.Layouts.CategoryMaster')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div><a href="{{route('Admin#ProductsLists')}}" class=" text-decoration-none text-dark fs-5 "><i class="fa-solid fa-arrow-left text-dark me-2" ></i>Back</a></div>
            <div class="col-lg-8 offset-2">
                <div class="card mt-5" style="border-radius: 20px">
                    <div class="card-body" >
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Detail</h3>
                           <div class="row">
                                <div class="col-4 offset-2 ">
                                    <div class="pt-5 mt-4">
                                            <img src="{{asset('storage/'.$Products->image)}}" class="img-thumbnail"   alt="..."/>
                                    </div>
                                </div>
                                <div class="col-5 offset-1">
                                    <form action="{{ route('Admin#ProductEdit',$Products->id)}}" method="POST" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label  class="control-label mb-1 ">Products Name</label>
                                            <input  name='pizzaName' value="{{old('pizzaName',$Products->name)}}" type="text" class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Pizza...">
                                        @error('pizzaName')
                                        <div  class="invalid-feedback" style="font-size:10px;">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1 d-block">Category</label>
                                            <select name="pizzaCategory"  value="{{ old('pizzaCategory')}}"  class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                    @foreach ($Categories as $item)
                                                    <option value="{{$item->id}}" @if ($Products->category_id == $item->id) selected @endif >{{$item->name}}</option>
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
                                            <textarea name='pizzaDescription' rows="10"   class="form-control @error('pizzaDescription') is-invalid @enderror" placeholder="Pizza information...">{{ old('pizzaDescription',$Products->description)}}</textarea>
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
                                            <input  name='pizzaWaitingTime' value="{{old('pizzaWaitingTime',$Products->waiting_time)}}" type="text" class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Waiting Time..." >
                                            @error('pizzaWaitingTime')
                                            <div  class="invalid-feedback" style="font-size:10px;">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label  class="control-label mb-1 ">Price</label>
                                            <input  name='pizzaPrice' value="{{old('pizzaPrice',$Products->price)}}" type="number" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Pizza Price...">
                                            @error('pizzaPrice')
                                            <div  class="invalid-feedback" style="font-size:10px;">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="text-end">
                                            <button id="payment-button" type="submit" class="btn  btn-dark w-50 ">
                                                Edit
                                            </button>
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
