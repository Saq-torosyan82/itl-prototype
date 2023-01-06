@extends('layouts.app')
@section('content')
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-12">
                    <div class="card-box">

                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-12">
                                <h4 class="page-title page-title-with-buttons">Job Details - {{$job->job_title}}
                                    <div class="float-right">
                                        <button class="btn btn-primary">Save Job</button>
                                        <button class="btn btn-primary">Apply To Job</button>
                                    </div>
                                </h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
                                <p class="font-weight-bold mb-0">Job Title</p>
                                <p class="job-title-preview">{{$job->job_title}}</p>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
                                <p class="font-weight-bold mb-0">Job Location</p>
                                <p class="job-title-preview">{{$job->job_location}}</p>
                            </div>
                            <div class="col-md-4 col-lg-4 col-xl-4 col-sm-12">
                                <p class="font-weight-bold mb-0">Pay Range</p>
                                <p class="job-title-preview">{{$job->pay_range}}</p>
                            </div>
                        </div>


                        <div class="row mb-2">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                                <p class="font-weight-bold mb-0">Job Description</p>
                                <div>{{$job->job_description}}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-sm-12">
                                <p class="font-weight-bold mb-0">Job Requirements</p>
                                <div>{{$job->job_requirements}}</div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <h4 class="page-title">Company Details</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-12">
                                <p class="font-weight-bold mb-0">Company Description</p>
                                <div>Company Description</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <p class="font-weight-bold mb-0">Company Name</p>
                                <div>Company Name</div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <p class="font-weight-bold mb-0">Size of Company</p>
                                <div>Company Size</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
