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
                        <form class="form-horizontal" method="POST" action="{{route('final-register/candidate')}}">
                            @csrf
                            <input type="hidden" name="registration_type" value="agency">
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="first_name">First Name</label>
                                    <input class="form-control" type="text" id="first_name" required="required" name="first_name" placeholder="Enter you first name" value="{{old('first_name')}}">
                                </div>
                                <div class="col-6">
                                    <label for="last_name">Last Name</label>
                                    <input class="form-control" type="text" id="last_name" required="required" name="last_name" placeholder="Enter you last name" value="{{old('last_name')}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    Phone
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-3">
                                    <label for="phone_code">Country Code</label>
                                    <select class="form-control" name="phone_code">
                                        <option value="" selected="selected" disabled="disabled"></option>
                                        @foreach($phone_codes as $code)
                                            <option value="{{$code}}">{{$code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-9">
                                        <label for="phone">Phone Number</label>
                                        <input class="form-control" type="text" id="phone" required="required" name="phone" placeholder="Enter you phone" value="{{old('phone')}}">
                                </div>
                            </div>
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
                                    <div class="padding-left-1rem checkbox checkbox-success">
                                        <input class="form-control" id="agree_recieve" type="checkbox" name="agree_recieve">
                                        <label for="agree_recieve">
                                            <span>I agree to recieve news and or marketing emails from ITL</span>
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