@extends('frontEnd.master')

@push('css')
    <!--styles for this page -->

@endpush


@section('banner')

@endsection


@section('mainContent')
    <section id="main-content">
        <section class="wrapper">
            <div class="container">

                <div class="properties-listing spacer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">

                            <div class="card">
                                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                                <div class="card-body">
                                    @if (session('resent'))
                                        <div class="alert alert-success" role="alert">
                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                        </div>
                                    @endif

                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                    {{ __('If you did not receive the email click on the below button to get one') }} <a class="btn btn-primary" href="{{ route('verification.resend') }}">{{ __('Get a link') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </section>

@endsection

@push('js')

@endpush
