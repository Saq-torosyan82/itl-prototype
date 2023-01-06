@extends("layouts.guest")
@section("content")
    <body class="authentication-bg bg-primary authentication-bg-pattern d-flex align-items-center pb-0 mt-3">
    <div class="container-fluid">
        <div class="row justify-content-center" id="applicant-registration-form">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mb-0">

                    <div class="card-body p-4">

                        <div class="account-box">
                            <div class="account-logo-box">
                                <div class="text-center">
                                    <a href={{route('welcome')}}>
                                        ITL Prototype
                                    </a>
                                </div>
                                <h5 class="text-uppercase mb-1 mt-4 text-center">Sign Up by Invitation (Step 2)</h5>
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
                                <form class="form-horizontal" method="POST" action="{{route('create.invited.client')}}">
                                    @csrf
                                    <input type="hidden" name="step" value="2">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="first_name">First Name</label>
                                            <input class="form-control" type="text" id="first_name" required="required" name="first_name" placeholder="Enter First Name" value="{{old('first_name')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="last_name">Last Name</label>
                                            <input class="form-control" type="text" id="last_name" required="required" name="last_name" placeholder="Enter First Name" value="{{old('last_name')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="person_phone">Phone number</label>
                                            <input class="form-control" type="text" id="person_phone" required="required" name="person_phone" placeholder="Enter Phone Number" value="{{old('person_phone')}}">
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

                                    <div class="form-group row text-center mt-2">
                                        <div class="col-4 offset-4">
                                            <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign Up</button>
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
    </div>
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