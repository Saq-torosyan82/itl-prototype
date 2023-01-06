@extends('layouts.app')
@section('content')


<!--                    --><?php
//                        echo '<pre>';
//                        print_r($profileInf);
//                        ?>
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
                                    <li class="breadcrumb-item active">Edit My Profile</li>
                                </ol>
                            </div>

                            <h4 class="page-title">Edit My Profile</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-sm-12 text-center">
                                    <!-- profile image -->
                                    --><?php
                                    if (Auth::user()->hasRole('applicant')) {
                                        $imgDir = "users";
                                        $route  = "save-picture";
                                    } elseif (Auth::user()->hasRole('employer')) {
                                        $imgDir = "companies";
                                        $route  = "save-logo";
                                    }
                                    ?>
                                    <img src='{{$profile->image ? asset("assets/images/{$imgDir}/{$profile->image}") : asset("assets/images/no_image.png")}}' class="img-fluid rounded-circle">
{{--                                    <form enctype="multipart/form-data" id="uploadPicture" role="form" method="POST" action="{{route($route)}}">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="id" value="{{$profile->user_id}}">--}}
{{--                                        <p>Profile Picture</p>--}}
{{--                                        <div class="custom-file">--}}
{{--                                            <input  id="customFile" style="cursor: pointer;" type="file" class="custom-file-input">--}}
{{--                                            <label style="text-align: left; cursor: pointer;" class="custom-file-label" for="customFile">Choose file</label>--}}
{{--                                        </div>--}}
{{--                                    </form>--}}
                                    <!-- end of profile image -->
                                </div>

                                <div class="col-lg-9 col-md-6 col-sm-12">
                                    <h3>My Profile</h3>
                                    <p>Primary E-mail: {{Auth::user()->email}}</p>
                                    <hr>
{{--                                    <form class="form-horizontal" method="POST" action="{{route('profile')}}">--}}
                                        @csrf

{{--                                        @if(Auth::user()->hasRole('employer'))--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-lg-8 col-md-8 col-sm-12">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label class="col-form-label" for="company_description">Company Description</label>--}}
{{--                                                        <textarea class="form-control" id="company_description" name="company_description" required="required">--}}
{{--                                                    {{$profile->company_description ? $profile->company_description : old('company_description')}}--}}
{{--                                                </textarea>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}

                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="first_name">First Name</label>
                                                    <input type="text" name="first_name" id="first_name" required="required" class="form-control" value="{{Auth::user()->first_name}}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label" for="last_name">Last Name</label>
                                                    <input type="text" name="last_name" id="last_name" required="required" class="form-control" value="{{Auth::user()->last_name}}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label" for="phone">Phone Number</label>
                                                    <input type="tel" id="phone" name="phone" class="form-control" value="{{$profile->phone ? $profile->phone : old('phone') }}">
                                                </div>

                                                @if(Auth::user()->hasRole('applicant'))
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="phone">Secondary Phone Number </label>
                                                        <input type="tel" id="secondary-phone" name="secondary_phone" class="form-control" value="{{$profile->secondary_phone ? $profile->secondary_phone : old('secondary_phone') }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label" for="email"> Email</label>
                                                        <input type="email" disabled id="email-user" name="email" class="form-control" value="{{Auth::user()->email}}">
                                                    </div>
                                                @endif

                                                <div class="form-group">
                                                    <label class="col-form-label" for="email">Secondary Email</label>
                                                    <input type="email" id="email" name="secondary_email" class="form-control" value="{{$profile->secondary_email ? $profile->secondary_email : old('secondary_email') }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="address">Address</label>
                                                    <input type="text" id="address" name="address" class="form-control" required="required" value="{{$profile->address ? $profile->address : old('address') }}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label" for="city">Town / City</label>
                                                    <input type="text" id="city" name="city" class="form-control" value="{{$profile->city ? $profile->city : old('city')}}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label" for="county">County</label>
                                                    <select class="form-control" name="county">
                                                        <option value="" selected="selected" disabled="disabled"></option>
{{--                                                        @foreach($counties as $county)--}}
{{--                                                            {{$selected = ""}}--}}
{{--                                                            @if ($county == $profile->county)--}}
{{--                                                                <option value="{{$county}}" selected="selected">{{$county}}</option>--}}
{{--                                                            @elseif ($county == old('county'))--}}
{{--                                                                <option value="{{$county}}" selected="selected">{{$county}}</option>--}}
{{--                                                            @else--}}
{{--                                                                <option value="{{$county}}">{{$county}}</option>--}}
{{--                                                            @endif--}}
{{--                                                        @endforeach--}}
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label" for="province">Province</label>
                                                    <select class="form-control" name="province">
                                                        <option value="" selected="selected"></option>
{{--                                                        @foreach($provinces as $province)--}}
{{--                                                            {{$selected = ""}}--}}
{{--                                                            @if ($province == $profile->province || $province == old('province'))--}}
{{--                                                                <option value="{{$province}}" selected="selected">{{$province}}</option>--}}
{{--                                                            @else--}}
{{--                                                                <option value="{{$province}}">{{$province}}</option>--}}
{{--                                                            @endif--}}
{{--                                                        @endforeach--}}
                                                    </select>
                                                </div>

                                                @if(Auth::user()->hasRole('applicant'))
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="emergency_contact_name">Emergency Contact Name</label>
                                                        <input type="text" id="emergency-contact-name" name="emergency_name" class="form-control" value="{{$profile->emergency_name ? $profile->emergency_name : old('emergency_contact_name') }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label" for="emergency_contact_phone_number">Emergency Contact Phone Number</label>
                                                        <input type="tel" id="mergency-ontact-phone-umber" name="emergency_phone" class="form-control" value="{{$profile->emergency_phone ? $profile->emergency_phone : old('emergency_contact_phone_number') }}">
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="postal_code">Postal Code / Eircode</label>
                                                    <input type="text" id="postal_code" name="postal_code" class="form-control" value="{{$profile->postal_code ? $profile->postal_code : old('postal_code') }}">
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label" for="country">Country</label>
                                                    <select class="form-control" name="country">
                                                        <option value="" selected="selected"></option>
{{--                                                        @foreach($countries as $country)--}}
{{--                                                            {{$selected = ""}}--}}
{{--                                                            @if ($country == $profile->country || $country == old('country'))--}}
{{--                                                                <option value="{{$country}}" selected="selected">{{$country}}</option>--}}
{{--                                                            @else--}}
{{--                                                                <option value="{{$country}}">{{$country}}</option>--}}
{{--                                                            @endif--}}
{{--                                                        @endforeach--}}
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label" for="country">Cities in IE</label>
                                                    <select class="form-control" name="cities-ie">
                                                        <option>test1</option>
                                                        <option>test2</option>
                                                        <option>test3</option>
                                                    </select>
                                                </div>

                                                @if (Auth::user()->hasRole('applicant'))
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="pps">PPS Number</label>
                                                        <input type="text" id="pps" name="pps" class="form-control" value="{{$profile->pps ? $profile->pps : old('pps')  }}">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label" for="seeking-employment-1">Actively Seeking Employment</label>
                                                        <div class="row mt-1">
                                                            <div class="col-6">
                                                                <input type="radio" name="seeking_employment" value="1" id="seeking-employment-1" @if ($profile->seeking_employment == 1) checked="checked" @endif/>
                                                                <label for="seeking-employment-1" class="ml-1">Yes</label>
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="radio" name="seeking_employment" value="0" id="seeking-employment-0" @if ($profile->seeking_employment == 0 || $profile->seeking_employment == null) checked="checked" @endif/>
                                                                <label for="seeking-employment-0" class="ml-1">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if (Auth::user()->hasRole('employer'))
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="company">Company Name</label>
                                                        <input type="text" id="company" name="company" class="form-control" value="{{$profile->company ? $profile->company : old('company') }}">
                                                    </div>

                                                    <div class="form-group mb-4">
                                                        <label class="col-form-label" for="vat">VAT Number</label>
                                                        <input type="text" id="vat" name="vat" class="form-control" value="{{$profile->vat ? $profile->vat : old('vat') }}">
                                                    </div>
                                                @endif

                                                @if(Auth::user()->hasRole('applicant'))
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="emergency-contact-relationship">Emergency Contact Relationship</label>
                                                        <input type="text" id="emergency-contact-relationship" name="emergency_relationship" class="form-control" value="{{$profile->emergency_relationship ? $profile->emergency_relationship : old('emergency_contact_relationship') }}">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if (Auth::user()->hasRole('applicant'))
                                            <h3 class="mt-4">Additional Info</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="transport">Own Transport</label>
                                                        <div class="row mt-1">
                                                            <div class="col-6">
                                                                <input type="radio" name="own_transport" value="1" id="own_transport_1" @if ($profile->own_transport == 1) checked="checked" @endif/>
                                                                <label for="own_transport_1" class="ml-1">Yes</label>
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="radio" name="own_transport" value="0" id="own_transport_0" @if ($profile->own_transport == 0 || $profile->own_transport == null) checked="checked" @endif/>
                                                                <label for="own_transport_0" class="ml-1">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="driving_license">Driving License Type</label>
                                                        <select class="form-control" name="driving_license">
                                                            <option value="Standard" @if($profile->driving_license == "Standard") selected="selected" @endif>Standard</option>
                                                            <option value="Commercial" @if($profile->driving_license == "Commercial") selected="selected" @endif>Commercial</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if (Auth::user()->hasRole('applicant'))
    @include('components.cover-letters.create-new-modal')
    @include('components.cover-letters.file-delete-dialog')
@endif

@include('modals.error')

@endsection



