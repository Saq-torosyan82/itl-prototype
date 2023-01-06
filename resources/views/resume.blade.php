@extends('layouts.app')
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box clearfix">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">ITL Prototype</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">My Resume/CVs</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Manage My Resumes/CVs</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
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
                        @if(session('success'))
                                <div class="alert alert-success text-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p>{{__("Resume Edited")}}</p>
                                </div>
                        @endif
                            @if(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p>{{__("The title has already been taken.")}}</p>
                                </div>
                            @endif
                            @if(session('delete'))
                                <div class="alert alert-success text-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p>{{__("Resume Deleted")}}</p>
                                </div>
                            @endif
                    </div>
                </div>

                <div id="documents-section" class="row" data-type="applicant_resume">
                @include('components.documents.main', [
                    'doc_type'       => "applicant_resume",
                    'header_title'   => "My Resumes/CVs",
                    'upload_btn_txt' => "Upload New Resume"
                ])
                </div>

                <!--div class="row">
                    <div class="col-10">
                        <div class="card-box">

                            <div class="flex-row justify-content-between">
                                <h2 class="header-title clearfix">My Resumes/CVs

                                    <button type="button" class="btn btn-blue btn-sm ml-4 float-right" data-target="#resume-modal" data-toggle="modal">Upload New Resume</button>
                                </h2>
                            </div>
                            <div class="table-responsive">
                                <div class="sk-circle">
                                    <div class="sk-circle1 sk-child"></div>
                                    <div class="sk-circle2 sk-child"></div>
                                    <div class="sk-circle3 sk-child"></div>
                                    <div class="sk-circle4 sk-child"></div>
                                    <div class="sk-circle5 sk-child"></div>
                                    <div class="sk-circle6 sk-child"></div>
                                    <div class="sk-circle7 sk-child"></div>
                                    <div class="sk-circle8 sk-child"></div>
                                    <div class="sk-circle9 sk-child"></div>
                                    <div class="sk-circle10 sk-child"></div>
                                    <div class="sk-circle11 sk-child"></div>
                                    <div class="sk-circle12 sk-child"></div>
                                </div>

                                <div id="resume-table-placeholder" class="hide"></div>

                            </div>
                        </div>
                    </div>
                </div-->
            </div>
        </div>
    </div>
    @include('modals.resume-modal')
    @include('modals.delete-resume')

@endsection
