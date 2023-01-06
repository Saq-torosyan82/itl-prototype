@extends('layouts.guest')
@section('content')
    <body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">

    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="text-center account-logo-box">
                                    <div>
                                        <a href="index.html">
                                            ITL Prototype
                                        </a>
                                    </div>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger text-danger alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        @foreach ($errors->all() as $error)
                                            <p>{{$error}}</p>
                                        @endforeach
                                    </div>
                                @endif

                                @if (session('status'))
                                    <div class="alert alert-success text-success alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <p>{{session('status')}}</p>
                                    </div>
                                @endif
                                <div class="account-content mt-4">
                                    <div class="text-center">
                                        <p class="text-muted mb-0 mb-3">Enter your email address and we'll send you an email with instructions to reset your password.  </p>
                                    </div>
                                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="email">Email address</label>
                                                <input class="form-control" name="email" type="email" id="email" required="required" placeholder="john@deo.com">
                                            </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Reset Password</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                    <div class="row mt-4">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted mb-0">Back to <a href="{{route('login')}}" class="text-dark ml-1"><b>Sign In</b></a></p>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- end card-box-->
                        </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
    </body>
@endsection

{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <div class="mb-4 text-sm text-gray-600">--}}
{{--            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}--}}
{{--        </div>--}}

{{--        <!-- Session Status -->--}}
{{--        <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--        <!-- Validation Errors -->--}}
{{--        <x-auth-validation-errors class="mb-4" :errors="$errors" />--}}

{{--        <form method="POST" action="{{ route('password.email') }}">--}}
{{--            @csrf--}}

{{--            <!-- Email Address -->--}}
{{--            <div>--}}
{{--                <x-label for="email" :value="__('Email')" />--}}

{{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                <x-button>--}}
{{--                    {{ __('Email Password Reset Link') }}--}}
{{--                </x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}
