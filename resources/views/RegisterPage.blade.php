@extends('Layouts.Master')

@section('content')
        <div class="login-form">
            <form action="{{ route('register') }}" method="post">
                @csrf
                @error('term')
                    <small class="text-danger" > {{ $message }} </small>
                @enderror

                <div class="form-group">
                    <label>Username</label>
                    <input class="au-input au-input--full" type="text" name="name" placeholder="Username" >
                    @error('name')
                        <small class="text-danger" > {{ $message }} </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                    @error('email')
                        <small class="text-danger" > {{ $message }} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input class="au-input au-input--full" type="text" name="phone_number" placeholder="09xxxxxxxxx">
                    @error('phone_number')
                        <small class="text-danger" > {{ $message }} </small>
                    @enderror
                </div>
                   <div class="form-group">
                    <label>Address</label>
                    <input class="au-input au-input--full" type="text" name="address" placeholder="Address">
                    @error('address')
                        <small class="text-danger" > {{ $message }} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                    @error('password')
                        <small class="text-danger" > {{ $message }} </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password Confirmation</label>
                    <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
                    @error('password_confirmation')
                        <small class="text-danger" > {{ $message }} </small>
                    @enderror
                </div>

                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

            </form>
            <div class="register-link">
                <p>
                    Already have account?
                    <a href="{{ route('Login#Page')}}">Sign In</a>
                </p>
            </div>
        </div>
@endsection



