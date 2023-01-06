@extends('layouts.app')
@section('content')
{{--{{dd(json_decode($jobSettingSearch->job_titles))}}--}}
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- breadcrumb -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">ITL Prototype</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Job Search Preferences</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Job Search Preferences</h4>
                        </div>
                    </div>
                </div>
                <!-- Job Search Preferences -->
                <form id="job_search_settings" method="POST" action="{{route('job-search-settings-save')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card-box card-box-jobs relative padding-margin-bottom-0">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h4 class="page-title">My Titles/Skills</h4>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <span style="margin-bottom: 5px; display: block;">Job Titles (Pick up to 10)</span>
                                        <button class="btn btn-primary button-add" type="button">Add</button>
                                        <div class="ti">
                                            <select class="job-title"  multiple data-role="tagsinput">
                                                @if (isset($jobSettingSearch->job_titles))
                                                    @foreach (json_decode($jobSettingSearch->job_titles) as $jobTitle)
                                                        <option value="{{$jobTitle}}">{{$jobTitle}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12">
                                        <span style="margin-bottom: 5px; display: block;">Skills (Pick up to 20)</span>
                                        <button class="btn btn-primary button-add" type="button">Add</button>
                                        <div class="ti">
                                            <select class="skills" multiple data-role="tagsinput">
                                                @if (isset($jobSettingSearch->skills))
                                                    @foreach (json_decode($jobSettingSearch->skills) as $skill)
                                                        <option value="{{$skill}}">{{$skill}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Employer Preferences -->
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <h4 class="page-title">Employer Preferences</h4>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12">
                                        <span style="margin-bottom: 5px; display: block;">Preferred Employers </span>
                                        <button class="button-add btn btn-primary" type="button">Add</button>
                                        <div class="ti">
                                            <select class="employe" multiple data-role="tagsinput">
                                                @if (isset($jobSettingSearch->skills))
                                                    @foreach (json_decode($jobSettingSearch->preferred_employees) as $prEmp)
                                                        <option value="{{$prEmp}}">{{$prEmp}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12">
                                        <span style="margin-bottom: 5px; display: block;">Excluded Employers </span>
                                        <button class="button-add btn btn-primary" type="button">Add</button>
                                        <div class="ti">
                                            <select class="excluded" multiple data-role="tagsinput">
                                                @if (isset($jobSettingSearch->skills))
                                                    @foreach (json_decode($jobSettingSearch->excluded_employees) as $exclEmp)
                                                        <option value="{{$exclEmp}}">{{$exclEmp}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!-- Location Preferences -->
                                <h4 class="page-title">Location Preferences</h4>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="transport">Find Employers Within (x) Distance Of Me</label>
                                            <div class="row mt-1">
                                                <div class="col-9 text-align-center">
{{--                                                    <input type="checkbox" name="find_emp" id="find_emp"--}}
{{--                                                           @if (isset($jobSettingSearch->willingToTravel) && $jobSettingSearch->distOfMe == 1) checked="checked" @endif--}}
{{--                                                    />--}}
                                                    <select name="distance_of_me" class="form-control" disabled>
                                                        <option value="x">Coming Soon</option>
                                                        <option value="5">5 km</option>
                                                        <option value="10">10 km</option>
                                                        <option value="15">15 km</option>
                                                        <option value="20">20 km</option>
                                                        <option value="50">50 km</option>
                                                        <option value="100">100+ km</option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="transport">I Am Willing To Travel For Work</label>
                                            <div class="row mt-1">
                                                <div class="col-3">
                                                    <input type="radio"
                                                           name="travel_for_work"
                                                           value="1"
                                                           id="travel_for_work_1"
                                                           @if (isset($jobSettingSearch->willingToTravel) && $jobSettingSearch->willingToTravel == 1) checked="checked" @endif
                                                    />
                                                    <label for="travel_for_work_1" class="ml-1">Yes</label>
                                                </div>
                                                <div class="col-6">
                                                    <input type="radio"
                                                           name="travel_for_work"
                                                           value="0"
                                                           id="travel_for_work_0"
                                                           @if ((isset($jobSettingSearch->willingToTravel) && $jobSettingSearch->willingToTravel == 0) || !isset($jobSettingSearch->willingToTravel))
                                                           checked="checked"
                                                        @endif

                                                    />
                                                    <label for="travel_for_work_0" class="ml-1">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 pb-3">
                                        <div class="form-group">
                                            <button id="saveToTable" type="button" class="btn btn-md mt-4 btn-primary waves-effect waves-light" onClick="saveJobSettingsSearchToTable(); return false;">
                                                Save Changes
                                            </button>
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
@include('modals.job-search-success')
@endsection
