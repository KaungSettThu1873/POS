@extends('Admin.Category.Layouts.CategoryMaster')

@section('title')
    <title> Admin Password </title>
@endsection

@section('content')

            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="col-lg-6 offset-3">
                            <div class="card mt-5" style="border-radius: 20px">
                                <div class="card-body" >
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Password Change</h3>
                                    </div>
                                    @if(session('NotSame'))
                                            <p class="text-danger"> {{ session('NotSame')}} </p>
                                    @endif
                                    <hr>
                                    <form action="{{ route('Admin#PasswordChange')}}" method="POST" novalidate="novalidate">
                                        @csrf
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Current Passwrod</label>
                                            <input id="cc-pament" name="currentPassword"   type="password" class="form-control @error('currentPassword')
                                            is-invalid
                                            @enderror "  aria-required="true" aria-invalid="false" placeholder="Enter current password">
                                            @error('currentPassword')
                                                <div  class="invalid-feedback" style="font-size:10px;">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">New Password</label>
                                            <input id="cc-pament" name="newPassword"  type="password" class="form-control @error('newPassword')
                                                is-invalid
                                            @enderror  "  aria-required="true" aria-invalid="false" placeholder="Enter new passsword">
                                            @error('newPassword')
                                                <div  class="invalid-feedback" style="font-size:10px;">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Confirmation Password</label>
                                            <input id="cc-pament" name="newConfirmationPassword"  type="password" class="form-control @error('newConfirmationPassword')
                                                is-invalid
                                            @enderror  "  aria-required="true" aria-invalid="false" placeholder="Enter confirmation password">
                                            @error('newConfirmationPassword')
                                                <div  class="invalid-feedback" style="font-size:10px;">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                <span id="payment-button-amount">Password Change</span>
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
