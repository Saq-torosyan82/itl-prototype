@extends("layouts.guest")
@section("content")
    <body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 vh-100">
    <div class="account-pages w-100 mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center" id="registration-splash">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">
                        <div class="card-body p-4">
                            <div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="index.html">
                                            <h4>ITL Prototype</h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="account-content mt-4">
                                    <div class="form-group row text-center mt-2">
                                        <div class="col-12">
                                            <h4 class="mb-1 text-center">Sign In</h4>
                                            <a href="{{route('login')}}">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="button">
                                                    {{__("Sign Into Your Account")}}
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <h4 class="mb-1 text-center">Sign In For Client</h4>
                                            <a href="{{route('login-client')}}">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="button">
                                                    {{__("Sign Into Client Account")}}
                                                </button>
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <h4 class="mb-1 text-center">Sign In For Candidate</h4>
                                            <a href="{{route('login-candidate')}}">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="button">
                                                    {{__("Sign Into Candidate Account")}}
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mb-0">
                        <div class="card-body p-4">
                            <div class="account-box">
                                    <h5 class="text-uppercase mb-1  text-center">Create Account</h5>
                                    <div class="form-group row text-center mt-2">
                                        <div class="col-12">
                                            <h4 class="mb-1 text-center">Job Seekers</h4>
                                            <a href="{{route('register')}}">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="button">
                                                    {{__("Search For Jobs")}}
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group row text-center mt-4">
                                        <div class="col-12">
                                            <h4 class="mb-1 text-center">Employers</h4>
                                            <a href="{{route('register/employer')}}">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="button">
                                                    {{__("Search For Applicants & Post Jobs")}}
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group row text-center mt-4">
                                        <div class="col-12">
                                            <h4 class="mb-1 text-center">Candidate</h4>
                                            <a href="{{route('register/candidate')}}">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="button">
                                                    {{__("Search For Candidate")}}
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group row text-center mt-4">
                                        <div class="col-12">
                                            <h4 class="mb-1 text-center">New Company Unique Account Creation</h4>
                                            <a href="{{route('register.company')}}">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="button">
                                                    {{__("Creation Company Account")}}
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
