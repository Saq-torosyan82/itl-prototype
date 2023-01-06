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
                                </ol>
                            </div>
                            <h4 class="page-title">Dashboard [Visual Demo]</h4>
                        </div>

                        <div class="card-box">
                            <div class="row">

                                <div class="col-12 mb-1">
                                    <h3 class="mb-1">Welcome, {{Auth::user()->first_name}}</h3>
                                    <small class="font-italic last-login">Last login: 2021/04/04</small>
                                </div>
                            </div>
{{--                            <div class="alert alert-success text-success alert-dismissible fade show mb-0 mt-2" role="alert">--}}
{{--                                <button type="button" class="close" data-dismiss="alert"--}}
{{--                                        aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                                <p>This is demonstation of a notification.</p>--}}
{{--                            </div>--}}
                            @if(Auth::user()->hasRole('applicant'))
                            <div class="row mt-3">
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card-box widget-box-two widget-two-custom">
                                        <div class="media">
                                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                                <i class="mdi mdi-equalizer avatar-title font-30 text-white"></i>
                                            </div>

                                            <div class="wigdet-two-content media-body">
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Jobs Applied To</p>
                                                <h3 class="font-weight-medium my-2"> <span data-plugin="counterup">12</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card-box widget-box-two widget-two-custom">
                                        <div class="media">
                                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                                <i class="mdi mdi-equalizer avatar-title font-30 text-white"></i>
                                            </div>

                                            <div class="wigdet-two-content media-body">
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total Job Vacancies</p>
                                                <h3 class="font-weight-medium my-2"> <span data-plugin="counterup">1,841</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card-box widget-box-two widget-two-custom">
                                        <div class="media">
                                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                                <i class="mdi mdi-equalizer avatar-title font-30 text-white"></i>
                                            </div>

                                            <div class="wigdet-two-content media-body">
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Resume Views</p>
                                                <h3 class="font-weight-medium my-2"> <span data-plugin="counterup">3</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card-box widget-box-two widget-two-custom">
                                        <div class="media">
                                            <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                                <i class="mdi mdi-equalizer avatar-title font-30 text-white"></i>
                                            </div>

                                            <div class="wigdet-two-content media-body">
                                                <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Jobs Matching Your Skills</p>
                                                <h3 class="font-weight-medium my-2"> <span data-plugin="counterup">12</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif(Auth::user()->hasRole('employer'))
                                <div class="row mt-3">
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                        <div class="card-box widget-box-two widget-two-custom">
                                            <div class="media">
                                                <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                                    <i class="mdi mdi-equalizer avatar-title font-30 text-white"></i>
                                                </div>

                                                <div class="wigdet-two-content media-body">
                                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Jobs Listed</p>
                                                    <h3 class="font-weight-medium my-2"> <span data-plugin="counterup">12</span></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                        <div class="card-box widget-box-two widget-two-custom">
                                            <div class="media">
                                                <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                                    <i class="mdi mdi-equalizer avatar-title font-30 text-white"></i>
                                                </div>

                                                <div class="wigdet-two-content media-body">
                                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Total Candidates</p>
                                                    <h3 class="font-weight-medium my-2"> <span data-plugin="counterup">1,841</span></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                        <div class="card-box widget-box-two widget-two-custom">
                                            <div class="media">
                                                <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                                    <i class="mdi mdi-equalizer avatar-title font-30 text-white"></i>
                                                </div>

                                                <div class="wigdet-two-content media-body">
                                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Candidates Matching Job Skills</p>
                                                    <h3 class="font-weight-medium my-2"> <span data-plugin="counterup">3</span></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                                        <div class="card-box widget-box-two widget-two-custom">
                                            <div class="media">
                                                <div class="avatar-lg rounded-circle bg-primary widget-two-icon align-self-center">
                                                    <i class="mdi mdi-equalizer avatar-title font-30 text-white"></i>
                                                </div>

                                                <div class="wigdet-two-content media-body">
                                                    <p class="m-0 text-uppercase font-weight-medium text-truncate" title="Statistics">Job Views</p>
                                                    <h3 class="font-weight-medium my-2"> <span data-plugin="counterup">12</span></h3>
                                                </div>
                                            </div>
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
@endsection
