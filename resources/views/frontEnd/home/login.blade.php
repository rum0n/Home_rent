@extends('frontEnd.master')

@section('title','Login Page')

@push('css')
        <!--styles for this page -->

@endpush

@section('mainContent')

<!-- login-starts -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-md-offset-3 form_setup">

                <center><h1 class="text-info">Sign in</h1></center>

                <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2">Email address</label>
                        <input id="exampleInputEmail2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2">Password</label>
                        <input id="exampleInputPassword2" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                    </div>

                    <div class="checkbox">

                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>

                    </div>
                    <button type="submit" class="btn btn-success">
                        {{ __('Login') }}
                    </button>

                </form>


                <div class="center">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif


                    <h4>New User Sign Up</h4>
                    
                    <button type="submit" class="btn btn-info"  onclick="window.location.href='{{ route('register') }}'">Join Now</button>

                    <button type="submit" class="btn btn-danger"  onclick="window.location.href='{{ url('login/google') }}'"><i class="fa fa-google-plus"></i> Login with Google</button>
                </div>

            </div>
        </div>
    </div>

<!-- /.login-ends -->


@endsection