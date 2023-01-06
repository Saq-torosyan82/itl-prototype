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
                                    <li class="breadcrumb-item active">Create Job Post</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Create Job Post</h4>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal" id="submit-job-post" method="POST" action="{{route('post-job')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="job_title">Job Title</label>
                                            <input type="text" class="form-control" name="job_title" id="job_title" placeholder="Assistant Manager" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="job_location">Job Location</label>
                                            <input type="text" class="form-control" name="job_location" id="job_location" placeholder="Dublin" required autofocus>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="pay_range">Pay Range</label>
                                            <input type="text" class="form-control" name="pay_range" id="pay_range" placeholder="€2500 - €3000" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <button class="btn btn-primary" type="button">Save Draft</button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <label for="job-description-summernote">Job Description</label>
                                        <textarea name="job_description" id="job-description-summernote"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-8 col-lg-8">
                                        <label for="job-requirements-summernote">Job Requirements</label>
                                        <textarea name="job_requirements" id="job-requirements-summernote"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" id="preview-job-posting">Preview Job Post</button>
                                            <button type="button" class="btn btn-success" id="publish-job-posting-options">Publish Options</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@include('modals.job-post-preview')
@include('modals.job-post-schedule')
@endsection
