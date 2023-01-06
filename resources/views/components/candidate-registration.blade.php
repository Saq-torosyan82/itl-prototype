<div class="row justify-content-center" id="applicant-registration-form">
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
                        <h5 class="text-uppercase mb-1 mt-4 text-center">Candidate / Applicant Sign Up</h5>
                        <p class="mb-0 text-center">Please enter your credentials</p>
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
                        <form class="form-horizontal" method="POST" action="{{route('post-register/candidate')}}">
                            @csrf
                            <input type="hidden" name="registration_type" value="agency">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="first_name">Email Address</label>
                                    <input class="form-control" type="text" id="email_address" required="required" name="email" placeholder="Enter you e-mail" value="{{old('email')}}">
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


                            <div class="g-recaptcha" data-sitekey={{config('app.captcha_key')}}></div>

                            <div class="form-group row text-center mt-2">
                                <div class="col-4 offset-4">
                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Next</button>
                                </div>
                            </div>

                        </form>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <p>Or Sign Up With:</p>
                                    <button type="button" class="btn mr-1 btn-facebook waves-effect waves-light">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                    <button type="button" class="btn mr-1 btn-googleplus waves-effect waves-light">
                                        <i class="fab fa-google"></i>
                                    </button>
                                    <button type="button" class="btn mr-1 btn-twitter waves-effect waves-light">
                                        <i class="fab fa-twitter"></i>
                                    </button>
                                    <button type="button" class="btn mr-1 btn-linkedin waves-effect waves-light">
                                        <i class="fab fa-linkedin-in"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 pt-2">
                            <div class="col-sm-12 text-center">
                                <p class="text-muted">Already have an account?  <a href="{{route('login-candidate')}}" class="text-dark ml-1"><b>Sign In</b></a></p>
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
