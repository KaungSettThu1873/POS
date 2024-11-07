@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Customer Messages Detail </title>
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <a href="{{ route('Customer#MessageLists') }}" class="text-dark text-decoration-none"><i
                        class="fa-solid fa-arrow-left me-1"></i>Back</a>
                <div class="col-md-12">
                    <div class="col-lg-10 bg-white offset-1 mb-5 mt-3 rounded-4" style="height: 500px">
                        <h4 class="text-dark fw-bold text-center pt-3">Customer Message</h4>
                        <div class="row mb-2 mt-3">
                            <span class="col-3 fw-bold text-dark"><i class="fa-solid fa-user me-2"></i>Name </span>-
                            <span class="col-6 fw-bold text-dark">{{ $contact->name }}</span>
                        </div>
                        <div class="row mb-2">
                            <span class="col-3 fw-bold text-dark"><i class="fa-solid fa-barcode me-2"></i>Email</span>-
                            <span class="col-6 fw-bold text-dark">{{ $contact->email }}</span>
                        </div>
                        <div class="row mb-2">
                            <span class="col-3 fw-bold text-dark"><i class="fa-solid fa-message me-2"></i></i>Message</span>-
                            <span class="col-6 fw-bold text-dark">{{ $contact->message }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
