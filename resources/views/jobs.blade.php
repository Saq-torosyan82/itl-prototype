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
                                    <li class="breadcrumb-item active">Search Job Vacancies</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Search For Jobs</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box card-box-jobs">
                            <div class="card-box-jobs-header">
                                <div class="form-group">
                                    <button class="btn btn-md btn-primary waves-effect waves-light mt-2 btn-realed-profile" onclick="performJobSearch('profile')">See Jobs Related To My Profile</button>
                                </div>
                                <span>Search By Keyword(s)</span>
                                <input type="text" name="" id="keyword-job-input" class="form-control" >
                                <div class="form-group">
                                    <button class="btn btn-md btn-primary waves-effect waves-light mt-2 btn-search-keyword" onclick="performJobSearch('keyword')">Search</button>
                                </div>
                            </div>
{{--                            <h4 class="header-title">Current Job Vacancies</h4>--}}

{{--                            <div class="table-responsive">--}}

{{--                                <table class="table mb-0">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Date Added</th>--}}
{{--                                        <th>Employer</th>--}}
{{--                                        <th>Job Title</th>--}}
{{--                                        <th>Description</th>--}}
{{--                                        <th>Pay Rate</th>--}}
{{--                                        <th></th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                   @foreach($jobs as $job)--}}
{{--                                           <tr>--}}
{{--                                        <td>{{$job->created_at}}</td>--}}
{{--                                        <td>{{$job->employer}}</td>--}}
{{--                                        <td>{{$job->job_title}}</td>--}}
{{--                                        <td>{{$job->description}}</td>--}}
{{--                                        <td>{{$job->pay}}</td>--}}
{{--                                        <td>--}}
{{--                                            <div class="flex-column">--}}
{{--                                                <button type="button" class="btn btn-blue rbtn-sm">Bid On This Job</button>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
                            <div class="card-box-jobs-filters center-block">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <span>
                                        Additional Search Filters
                                    </span>
                                    <svg data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" width="20" height="11" viewBox="0 0 23 14" fill="none" xmlns="http://www.w3.org/2000/svg" class="search-filters collapsed ">
                                        <path d="M2 1.75L11.5 11.25L21 1.75" stroke="grey" stroke-width="3"/>
                                    </svg>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="search-parent">
                                                <div class="under-construction align-content-center">
                                                    <h4 class="text-white">Under Construction</h4>
                                                </div>

                                                <div class="content-search">
                                                    <span>Job Titles</span>
                                                    <input type="text" name="" class="form-control" >
                                                    <span>Skills</span>
                                                    <input type="text" name="" class="form-control" >
                                                    <span>Shift Times</span>
                                                    <select class="form-control" name="city" id="city" required="required">
                                                        <option value="" selected="selected" disabled="disabled"></option>
                                                        <option value="Ardee">option1</option>
                                                        <option value="Arklow">option2</option>
                                                    </select>
                                                </div>
                                                <div class="content-search">
                                                    <span>Preferred Employers</span>
                                                    <input type="text" name=""  class="form-control" >
                                                    <span>Exclude Employers</span>
                                                    <input type="text" name="" class="form-control" >
                                                    <span>Length Of Job</span>
                                                    <select class="form-control" name="city" id="city" required="required">
                                                        <option value="" selected="selected" disabled="disabled"></option>
                                                        <option value="Ardee">option1</option>
                                                        <option value="Arklow">option2</option>
                                                    </select>
                                                </div>
                                                <div class="content-search">
                                                    <span>Pay Range</span>
                                                    <select class="form-control" name="city" id="city" required="required">
                                                        <option value="" selected="selected" disabled="disabled"></option>
                                                        <option value="Ardee">option1</option>
                                                        <option value="Arklow">option2</option>
                                                    </select>
                                                    <span>Location</span>
                                                    <input type="text" name="" class="form-control" >
                                                    <span>Distance from Location</span>
                                                    <select class="form-control" name="city" id="city" required="required">
                                                        <option value="" selected="selected" disabled="disabled"></option>
                                                        <option value="Ardee">option1</option>
                                                        <option value="Arklow">option2</option>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="search-result-jobs">
                                    <h4>Search Results</h4>
                                    <button class="btn btn-md btn-primary waves-effect waves-light mt-2 btn-save-search-jobs">Save Search Filters</button>
                                </div>
                                <div id="table-placeholder"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
