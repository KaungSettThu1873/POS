@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Category Edit  </title>
@endsection

@section('content')


        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3 offset-8">
                            <a href="{{route('Category#lists')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Category Update</h3>
                                </div>
                                <hr>
                                <form action="{{route('Category#Update')}}" method="POST" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <input id="cc-pament" name="id"  type="hidden" class="form-control" value="{{old('categories_name',$data->id)}}" aria-required="true" aria-invalid="false" placeholder="Seafood...">
                                        <label for="cc-payment" class="control-label mb-1">Categories Name</label>
                                        <input id="cc-pament" name="categories_name"  type="text" class="form-control" value="{{old('categories_name',$data->name)}}" aria-required="true" aria-invalid="false" placeholder="Seafood...">
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
