<div class="row justify-content-center" id="employer-registration-form">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mb-0">

            <div class="card-body p-4">

                <div class="account-box">
                    <div class="account-logo-box">
                        <div class="text-center">
                            <a href="index.html">
                                ITL Prototype
                            </a>
                        </div>
                        <h5 class="text-uppercase mb-1 mt-4">Register</h5>
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
                    <div class="account-content mt-4">
                        <form class="form-horizontal" method="POST" action="{{route('register')}}">
                            <input type="hidden" name="registration_type" value="employer">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="company">Business Name</label>
                                    <input class="form-control" type="text" id="company" required="required" name="company" placeholder="Company LTD" value="{{old('company')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="first_name">Authorized Agent First Name</label>
                                    <input class="form-control" type="text" id="first_name" required="required" name="first_name" placeholder="Michael" value="{{old('first_name')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="last">Authorized Agent Last Name</label>
                                    <input class="form-control" type="text" id="last_name" required="required" name="last_name" placeholder="Zenaty" value="{{old('last_name')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="email">Email address</label>
                                    <input class="form-control" type="email" id="email" name="email" required="required" placeholder="john@deo.com" value="{{old('email')}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <label class="password" for="password">
                                        <span>Password</span>
                                        <span><a href="#" class="password-control"></a></span>
                                    </label>
                                    <input class="form-control" type="password" id="password" required="required" name="password" placeholder="Enter your password">

                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label class="password" for="repassword">
                                        <span>Re-Enter Password</span>
                                        <span><a href="#" class="password-control"></a></span>
                                    </label>
                                    <input class="form-control" type="password" id="repassword" name="password_confirmation" required="required" placeholder="Re Enter Password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="padding-left-1rem checkbox checkbox-success">
                                        <input class="form-control" id="remember" type="checkbox" name="agree">
                                        <label for="remember">
                                            <span>I agree to the</span>
                                            <button type="button" class="button-review" data-toggle="modal" data-target="#exampleModal">
                                                Terms & Conditions, Privacy Policy, and User Agreement
                                            </button>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="g-recaptcha" data-sitekey={{config('app.captcha_key')}}></div>

                            <div class="form-group row text-center mt-2">
                                <div class="col-12">
                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign Up Free</button>
                                </div>
                            </div>

                        </form>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <a href="{{ route('social.register', ['driver' => 'facebook', 'user_type' => 'employer']) }}" style="color: white;">
                                        <button type="button" class="btn mr-1 btn-facebook waves-effect waves-light">
                                            <i class="fab fa-facebook-f"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('social.register', ['driver' => 'google', 'user_type' => 'employer']) }}" style="color: white">
                                        <button type="button" class="btn mr-1 btn-googleplus waves-effect waves-light">
                                            <i class="fab fa-google"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('social.register', ['driver' => 'linkedin', 'user_type' => 'employer']) }}" style="color: white">
                                        <button type="button" class="btn mr-1 btn-linkedin waves-effect waves-light">
                                            <i class="fab fa-linkedin-in"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('social.register', ['driver' => 'apple', 'user_type' => 'employer']) }}" style="color: white">
                                        <button type="button" class="btn btn-apple">
                                            <i class="fab fa-apple"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 pt-2">
                            <div class="col-sm-12 text-center">
                                <p class="text-muted">Already have an account?  <a href="{{route('login')}}" class="text-dark ml-1"><b>Sign In</b></a></p>
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
