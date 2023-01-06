{{--<table class="table mb-0" id="applicant-resume-table">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th>Date Added</th>--}}
{{--        <th>Title</th>--}}
{{--        <th>File</th>--}}
{{--        <th>Primary</th>--}}
{{--        <th></th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--    @foreach($resumes as $resume)--}}

{{--        <tr>--}}
{{--            <td>{{date_format($resume->created_at,'Y-m-d')}}</td>--}}
{{--            <td class="title-resume">{{$resume->title}}</td>--}}
{{--            <td><a href=" {{$resume->filename}} " download> {{$resume->filename}} </a></td>--}}
{{--            <td>{{$resume->primary? 'Yes':'No'}}</td>--}}
{{--            <td align="right">--}}
{{--                <div class="row">--}}

{{--                    <div class="form-group form-inline">--}}

{{--                        <form method="POST" action="{{route('download-resume')}}">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="resume" value="{{$resume->filename}}">--}}
{{--                            <button title="Download" type="submit" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fe-download font-14"></i></button>--}}
{{--                            <button data-id="{{ $resume->id }}" data-href="{{$resume->filename}}" title="{{$resume->title}}" primary="{{$resume->primary}}" type="button" class="btn btn-success btn-sm edit-btn" data-index="' + index + '" ><i class="dripicons-document-edit" ></i></button>--}}
{{--                        </form>--}}
{{--                        <div class="ml-1">--}}
{{--                            <input type="hidden" name="resume" value="{{$resume->id}}">--}}
{{--                            <button title="Delete" type="button" data-title="{{$resume->title}}" class="btn btn-danger btn-sm delete-resume-button" id="resume_{{$resume->id}}" ><i class="fe-trash-2 font-14"></i></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--    </tbody>--}}
{{--</table>--}}
<div class="row">
    <div class="col-10">
        <div class="card-box card-error">
            <div class="flex-row justify-content-between">
                <h2 class="header-title clearfix">My Cover Letters
                    <button id="upload-letter-btn" type="button" class="btn btn-blue btn-sm ml-4 float-right">Upload New Cover Letter</button>
                </h2>
            </div>
            <div class="table-responsive">
                <table id="applicant-resume-table" class="table mb-0">
                    <thead>
                    <tr>
                        <th>Date Added</th>
                        <th>Title</th>
                        <th>File</th>
                        <th>Primary</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
