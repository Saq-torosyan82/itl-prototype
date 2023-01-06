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
                                    <li class="breadcrumb-item active">Search Resumes</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Search CVs/Resumes</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group text-center">
                                        <label for="search">Search</label>
                                        <input type="text" class="form-control" name="search" placeholder="Engineer">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>Jamie Dunn</th>
                                            <th>Action Buttons</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
