@extends("layouts.guest")
@section("content")
    <body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">



    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-6">
                    <div class="card mb-0">

                        <div class="card-body p-4">

                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="{{route('welcome')}}">
                                            ITL Prototype
                                        </a>
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4">Sign In</h5>
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
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="email">Email address</label>
                                                <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}" required="required" placeholder="john@deo.com">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <a href="{{route('password.request')}}" class="text-muted float-right"><small>Forgot your password?</small></a>
                                                <label class="password" for="password">
                                                    <span>Password</span>
                                                    <span><a href="#" class="password-control"></a></span>
                                                </label>
                                                <input class="form-control" type="password" id="password" required="required" name="password" placeholder="Enter your password">
                                            </div>
                                        </div>

                                        <div class="g-recaptcha" data-sitekey={{config('app.captcha_key')}}></div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <div class="padding-left-1rem checkbox checkbox-success">
                                                    <input class="form-control" id="agree_terms" type="checkbox" name="agree_terms">
                                                    <label for="agree_terms">
                                                        <span>I agree to the</span>
                                                        <button type="button" class="button-review" data-toggle="modal" data-target="#exampleModal">
                                                            Terms & Conditions, Privacy Policy, and User Agreement (Required)
                                                        </button>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-12">

                                                <div class="checkbox checkbox-success">
                                                    <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="remember">
                                                        Remember me
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group row text-center mt-2">
                                            <div class="col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="text-center">
                                                <a href="{{ route('social.login', 'facebook') }}" style="color: white;">
                                                    <button type="button" class="btn mr-1 btn-facebook waves-effect waves-light">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('social.login', 'google') }}" style="color: white">
                                                    <button type="button" class="btn mr-1 btn-googleplus waves-effect waves-light">
                                                        <i class="fab fa-google"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('social.login', 'linkedin') }}" style="color: white">
                                                    <button type="button" class="btn mr-1 btn-linkedin waves-effect waves-light">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('social.login', 'apple') }}">
                                                    <button type="button" class="btn btn-apple">
                                                        <i class="fab fa-apple"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4 pt-2">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted mb-0">Don't have an account? <a href="{{route('welcome')}}" class="text-dark ml-1"><b>Sign Up</b></a></p>
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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('components.terms')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Google script for recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js"></script>
    </body>
@endsection
