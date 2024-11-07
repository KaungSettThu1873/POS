@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Category Create  </title>
@endsection

@section('content')


        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">

                            <a href="{{ route('Category#lists') }}" class="text-dark text-decoration-none"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>

                    </div>
                    <div class="col-lg-6 offset-3">
                        <div class="card" style="border-radius: 20px">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Category Form</h3>
                                </div>
                                <hr>
                                <form action="{{ route('Category#Create')}}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1 ">Categories Name</label>
                                        <input id="cc-pament" name="categories_name" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Classic...">
                                    </div>
                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
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
