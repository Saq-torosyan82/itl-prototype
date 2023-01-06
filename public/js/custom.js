// JS/jQuery Functions
function loadJobPostingTimepicker(){
    $("#job-post-timepicker").timepicker({
        defaultTIme: false,
        icons: {
            up: 'mdi mdi-chevron-up',
            down: 'mdi mdi-chevron-down'
        }
    });
}
function loadJobPostingDatepicker(){
    $('#job-post-datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy/mm/dd'
    });
}
function openJobPostingScheduleModal(){
    if (document.querySelector('form').reportValidity()){
        $("#job-post-schedule-modal").modal("toggle");
    }
}

function performJobSearch(type){
    var data = {type: type};
    switch(type){
        case 'keyword':
            data.keyword = $("#keyword-job-input").val();
            break;
        case 'profile':
            break;
        default:
            return false;
    }

    $.ajax({
        url: "/job/search/table",
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: data,
        success: function(data){
            document.getElementById("table-placeholder").innerHTML = data;
        }
    });
}
function populateJobPreview(){

    var title = $("#job_title").val();
    var location = $("#job_location").val();
    var pay = $("#pay_range").val();
    var description = $("#job-description-summernote").val();
    var requirements = $("#job-requirements-summernote").val();

    $(".job-title-preview").text(title);
    $(".pay-range-preview").text(pay);
    $(".job-description-preview").html(description);
    $(".job-requirements-preview").html(requirements);
    $(".job-location-preview").text(location);

}
function openJobPostingPreviewModal(){
    populateJobPreview();
    $("#job-post-preview-modal").modal("toggle");
}
function loadJobDescriptionSummernote(){
    $("#job-description-summernote").summernote({
        height: 250,
        minHeight:null,
        maxHeight:null,
        focus:false,
        id: 1,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
    });
}

function loadJobRequirementsSummernote(){
    $("#job-requirements-summernote").summernote({
        height: 250,
        minHeight:null,
        maxHeight:null,
        focus:false,
        id: 2,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']],
        ],
    });
}

function formatDate(date) {
    let d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2)
        month = '0' + month;
    if (day.length < 2)
        day = '0' + day;

    return [year, month, day].join('-');
}

function makeAjaxData(data = {}) {
    let tokenObj = {_token: csrf_token};

    if (typeof(data) === 'object' && data !== null && !$.isEmptyObject(data)) {
        return {...data, ...tokenObj};
    }

    return tokenObj;
}

window.performJobSearch = performJobSearch;
window.saveJobSettingsSearchToTable = saveJobSettingsSearchToTable;

//Load Job Skills Tags
var check = document.getElementById("job-skills-select");
if (check){
    var skills = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: {
            url: '/get-skills',
            filter: function(list) {
                return $.map(list, function(skill) {
                    return { name: skill }; });
            }
        }
    });
    skills.initialize();

    $('#job-skills-select').tagsinput({
        typeaheadjs: {
            name: 'Skills',
            displayKey: 'name',
            valueKey: 'name',
            source: skills.ttAdapter(),

        }
    });

    $(".twitter-typeahead").on("typeahead:select", function(ev, sug){
        console.log(sug);
    });

}

function saveJobSettingsSearchToTable(){
    let jobTitles = JSON.stringify($('select.job-title').tagsinput('items'));
    let skills = JSON.stringify($('select.skills').tagsinput('items'));
    let employe = JSON.stringify($('select.employe').tagsinput('items'));
    let excluded = JSON.stringify($('select.excluded').tagsinput('items'));
    let willingToTravel = $("input[name=travel_for_work]:checked")[0].value;
    // let distOfMe = $("input[name=find_emp]")[0].checked ? 1 : 0;
    let distOfMe = 0;
    let csrf = $('meta[name="csrf-token"]')[0].content;
    let url = $("#job_search_settings")[0].action;

    let formData = {};
    formData.jobTitles = jobTitles;
    formData.skills = skills;
    formData.employe = employe;
    formData.excluded = excluded;
    formData.willingToTravel = willingToTravel;
    formData.distOfMe = distOfMe;

    $.ajax({
        type:'POST',
        url:url,
        data:formData,
        headers: {
            "X-CSRF-TOKEN": csrf
        },
        success:function(data) {
            $("#job-search-preferences-success-modal").modal("toggle");
        }
    });

}
function existsById(id){
    return document.body.contains(document.getElementById(id));
}

//Reset Resume Upload Modal on Close
// $("#resume-modal").on("hidden.bs.modal", resetResumeModal);
// $("#delete-resume-modal").on("hidden.bs.modal", resetDeleteConfirmationModal);

//Post Job - Load Job Description Summernote
if (existsById('job-description-summernote')){
    loadJobDescriptionSummernote();
}

//Post Job - Load Job Requirements Summernote
if (existsById('job-requirements-summernote')){
    loadJobRequirementsSummernote();
}

//Post Job - Preview Job Posting Button
$(document).on("click", "#preview-job-posting", openJobPostingPreviewModal);

//Post Job - Posting Options Button
$(document).on("click", "#publish-job-posting-options", openJobPostingScheduleModal);

//Post Job - datepicker
if (existsById('job-post-datepicker')){
    loadJobPostingDatepicker();
}

//Post Job - timepicker
if(existsById('job-post-timepicker')){
    loadJobPostingTimepicker();
}

$(document).on("click", "#cancel-schedule-job-post", function(){
    $("#select-publish-option").fadeIn("fast").removeClass("hide-important");
    $("#schedule-publish-div").addClass('hide-important');
    $("#publish-now-div").addClass('hide-important');
});

//Show Schedule Publishing Div
$(document).on("click", ".schedule-publishing-button", function(){
    $("#schedule-publish-div").fadeIn("fast").removeClass("hide-important");
    $("#select-publish-option").addClass('hide-important');
});

$(document).on("click", ".publish-now-button", function(){
    populateJobPreview();
    $("#publish-now-div").fadeIn("fast").removeClass("hide-important");
    $("#select-publish-option").addClass('hide-important');
});

$("#publish-job-post").on("click", function(){
    $("#submit-job-post").submit();
});

$("#job-post-schedule-modal").on("hidden.bs.modal", function(){
   $("#publish-now-div").addClass('hide-important');
   $("#schedule-publish-div").addClass('hide-important');
   $("#select-publish-option").removeClass('hide-important');
});

//Job Search Table - Table Row Link Handling
$(document).on("click", ".job-search-link", function(){
    var str = $(this).prop("id");
    var id = str.replace("job_", "");

    window.open('/job/'+id, '_blank');
});

$('select.job-title').tagsinput({
    maxTags: 10
});
$('select.skills').tagsinput({
    maxTags: 20
});
$('body').on('click', '.password-control', function(e){
    e.preventDefault();
    let elemWithPassword = e.target.closest('.password').nextElementSibling;
    let target = e.target;
    if ($(elemWithPassword).attr('type') == 'password'){
        $(target).addClass('view');
        $(elemWithPassword).attr('type', 'text');
    } else {
        $(target).removeClass('view');
        $(elemWithPassword).attr('type', 'password');
    }
});
