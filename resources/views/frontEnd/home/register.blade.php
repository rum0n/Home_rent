@extends('frontEnd.master')

@section('title','Sign Up')

@push('css')
        <!--styles for this page -->

@endpush

@section('mainContent')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-md-offset-3 form_setup">
                <center><h1 class="text-info">{{ __('Register') }}</h1></center>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name ') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        
                        </div>

                        <div class="form-group mb-0">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Register') }}
                                </button>
                        </div>

                    </form>
            <div class="text-center text-dark text-lg">
                <a class="btn btn-link" href="{{ route('login') }}">{{ __('Sign In') }}</a>

            </div>
               
        </div>
    </div>
</div>
@endsection
