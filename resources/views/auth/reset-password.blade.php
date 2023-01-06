<x-guest-layout>
    @section('content')
        <body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">
        <div class="account-pages w-100 mt-5 mb-5">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mb-0">

                            <div class="card-body p-4">

                                <div class="account-box">
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>



        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />



        <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ $request->email }}">

            <!-- Real Password -->
            <div class="mt-4">
                <label class="password" for="password">
                    <span>Password</span>
                    <span><a href="#" class="password-control"></a></span>
                </label>
                <input class="form-control" type="password" id="real_password" required="required" name="real_password" value="{{$request->password}}" readonly>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="password" for="password">
                    <span>Input New Password</span>
                    <span><a href="#" class="password-control"></a></span>
                </label>
                <input class="form-control" type="password" id="password" required="required" name="password" placeholder="Enter your password">
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <label class="password" for="repassword">
                    <span>Re-Enter New Password</span>
                    <span><a href="#" class="password-control"></a></span>
                </label>
                <input class="form-control" type="password" id="repassword" name="password_confirmation" required="required" placeholder="Re Enter Password">
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="btn-primary btn-block">
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
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
</x-guest-layout>
