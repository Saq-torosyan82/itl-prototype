@extends('layouts.app')
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">ITL Prototype</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Edit Company Profile</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Edit Company Profile {{$profile->company}}</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">

                                <div class="col-lg-2 col-md-4 col-sm-12 text-center">
                                    <?php $realPath = realpath("assets/images/companies/{$profile->image}");?>
                                    <img src='{{$profile->image && file_exists($realPath) ? asset("assets/images/companies/{$profile->image}") : asset("assets/images/no_image.png")}}'
                                         class="img-fluid rounded-circle">
                                    <form enctype="multipart/form-data" id="uploadPicture" role="form" method="POST"
                                          action="{{route('save-logo')}}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$profile->user_id}}">
                                        <p>Profile Picture</p>
                                        <div class="custom-file">
                                            <input style="cursor: pointer;" type="file" class="custom-file-input"
                                                   id="customFile">
                                            <label style="text-align: left; cursor: pointer;"
                                                   class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-lg-10 col-md-8 col-sm-12">
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
                                    <h3>Company Profile</h3>
                                    <p>Primary E-mail: {{Auth::user()->email}}</p>
                                    <hr>
                                    <form class="form-horizontal" method="POST" action="{{route('profile.company')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-8 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="company">Company Name</label>
                                                    <input type="text" id="company" name="company" {{$readOnly}} required="required"
                                                           class="form-control" value="{{$profile->company ? $profile->company : old('company') }}">
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label class="col-form-label" for="vat">VAT Number</label>
                                                    <input type="text" id="vat" name="vat" class="form-control" {{$readOnly}} required="required"
                                                           value="{{$profile->vat ? $profile->vat : old('vat') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="company_description">Company Description</label>
                                                    <textarea class="form-control" id="company_description" name="company_description" {{$readOnly}} required="required">{{$profile->company_description ? $profile->company_description : old('company_description')}}</textarea>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                @if (!$readOnly)
                                                    <h4>Company Contact Person</h4>
                                                @else
                                                    <h4>Company Contact Client</h4>
                                                @endif
                                                <div class="form-group">
                                                    <label class="col-form-label" for="first_name">First Name</label>
                                                    <input type="text"  name="first_name"   id="first_name" required="required" class="form-control" value="{{$user->first_name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="last_name">Last Name</label>
                                                    <input type="text"  name="last_name"    id="last_name"  required="required" class="form-control" value="{{$user->last_name}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="phone">Phone</label>
                                                    <input type="tel"   name="phone"        id="phone"      required="required" class="form-control" value="{{$user->phone}}">
                                                </div>

                                            </div>

                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <h4>Company Address</h4>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="contact_phone">Contact phone</label>
                                                    <input type="text" id="contact_phone" name="contact_phone" class="form-control" required="required" {{$readOnly}} value="{{$profile->phone}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="address">Address</label>
                                                    <input type="text" id="address" name="address" class="form-control" required="required" {{$readOnly}} value="{{$profile->address ? $profile->address : old('address')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="city">Town / City</label>
                                                    <input type="text" id="city" name="city" class="form-control" {{$readOnly}} value="{{$profile->city ? $profile->city : old('city')}}">
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="postal_code">Postal Code / Eircode</label>
                                                    <input type="text" id="postal_code" name="postal_code" class="form-control" {{$readOnly}} value="{{$profile->postal_code ? $profile->postal_code : old('postal_code') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <h4>&nbsp;</h4>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="county">County</label>
                                                    <select class="form-control" name="county" id="county" {{$readOnly}} required="required">
                                                        <option value="" selected="selected" disabled="disabled"></option>
                                                        @foreach($counties as $county)
                                                            {{$selected = ""}}
                                                            @if ($county == $profile->county)
                                                                <option value="{{$county}}" selected="selected">{{$county}}</option>
                                                            @elseif($county == old('county'))
                                                                <option value="{{$county}}" selected="selected">{{$county}}</option>
                                                            @else
                                                                <option value="{{$county}}">{{$county}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="province">Province</label>
                                                    <select class="form-control" name="province" id="province" {{$readOnly}} required="required">
                                                        <option value="" selected="selected" disabled="disabled"></option>
                                                        @foreach($provinces as $province)
                                                            {{$selected = ""}}
                                                            @if ($province == $profile->province)
                                                                <option value="{{$province}}" selected="selected">{{$province}}</option>
                                                            @elseif($province == old('province'))
                                                                <option value="{{$province}}" selected="selected">{{$province}}</option>
                                                            @else
                                                                <option value="{{$province}}">{{$province}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="country">Country</label>
                                                    <select class="form-control" name="country" id="country" {{$readOnly}}>
                                                        <option value="" selected="selected"></option>
                                                        @foreach($countries as $country)
                                                            {{$selected = ""}}
                                                            @if ($country == $profile->country || $country == old('country'))
                                                                <option value="{{$country}}" selected="selected">{{$country}}</option>
                                                            @else
                                                                <option value="{{$country}}">{{$country}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <button class="btn btn-md mt-4 btn-primary waves-effect waves-light" type="submit">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <h3 class="mt-4">Update Password</h3>
                                    <hr>
                                    <form class="form-horizontal" method="POST" action="{{route('updatepw')}}">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="password">New Password</label>
                                            <div class="col-md-10">
                                                <input type="password" id="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" for="password_confirmation">Confirm Password</label>
                                            <div class="col-md-10">
                                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row justify-content-end">
                                            <div class="col-md-12">
                                                <button class="btn btn-md btn-primary waves-effect waves-light" type="submit">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                    @if (!$readOnly)
                                        <h3 class="mt-4">Invite other users use the ITL platform</h3>
                                        <p><a class="btn btn-primary color" href="#" id="invite_other">Invite</a></p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.invite-user')
    @include('modals.error')
@endsection



