@extends("layouts.guest")
@section("content")
    <body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">
    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="{{route('welcome')}}">
                                            ITL Prototype
                                        </a>
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4">Sign In For Candidate</h5>
                                </div>

                                <!-- Validation Errors -->
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

                                <div class="account-content mt-4">
                                    <form class="form-horizontal" method="POST" action="{{ route('login-candidate') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="email">Email address</label>
                                                <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}" required="required" placeholder="john@deo.com">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <a href="{{route('password.candidate.request')}}" class="text-muted float-right"><small>Forgot your password?</small></a>
                                                <label class="password" for="password">
                                                    <span>Password</span>
                                                    <span><a href="#" class="password-control"></a></span>
                                                </label>
                                                <input class="form-control" type="password" id="password" required="required" name="password" placeholder="Enter your password">
                                            </div>
                                        </div>

                                        <div class="g-recaptcha" data-sitekey={{config('app.captcha_key')}}></div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center">
                                                <button type="button" class="btn mr-1 btn-facebook waves-effect waves-light">
                                                    <i class="fab fa-facebook-f"></i>
                                                </button>
                                                <button type="button" class="btn mr-1 btn-googleplus waves-effect waves-light">
                                                    <i class="fab fa-google"></i>
                                                </button>
                                                <button type="button" class="btn mr-1 btn-twitter waves-effect waves-light">
                                                    <i class="fab fa-twitter"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4 pt-2">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted mb-0">Don't have an account? <a href="{{route('register/candidate')}}" class="text-dark ml-1"><b>Sign Up</b></a></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
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
    <!-- Google script for recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    </body>
@endsection
