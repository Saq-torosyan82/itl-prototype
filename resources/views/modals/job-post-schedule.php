<div id="job-post-schedule-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Select Your Publishing Option</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="select-publish-option">
                    <div class="col-12">
                        <button class="btn btn-block btn-lg btn-primary schedule-publishing-button" type="button">Schedule Publishing</button>
                        <button class="btn btn-block btn-lg btn-primary publish-now-button mt-2" type="button">Publish Now</button>
                    </div>
                </div>

                <div class="row hide-important" id="publish-now-div">
                    <div class="col-10">
                        <h4>Confirm Your Job Posting</h4>
                        <div class="job-preview mt-2">

                            <p class="font-weight-bold mb-0">Job Title</p>
                            <p class="job-title-preview"></p>
                            <p class="font-weight-bold mb-0">Job Location</p>
                            <p class="job-location-preview"></p>
                            <p class="font-weight-bold mb-0">Pay Range</p>
                            <p class="pay-range-preview"></p>
                            <h4>Job Description</h4>
                            <p class="job-description-preview"></p>
                            <h4>Job Requirements</h4>
                            <p class="job-requirements-preview"></p>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" id="cancel-schedule-job-post">Go Back</button>
                            <button class="btn btn-primary" type="button" id="publish-job-post">Publish Now</button>
                        </div>
                    </div>
                </div>

                <div class="row hide-important"  id="schedule-publish-div">
                    <div class="col-10">
                        <h4>Schedule Publishing <span class="text-red ml-1 font-13">(Scheduling Unavailable At This Time)</span></h4>
                        <div class="mt-2">
                            <label for="job-post-datepicker">Date</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="job-post-datepicker" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <label for="job-post-timepicker">Time</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="12:00" id="job-post-timepicker" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-clock"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary" id="cancel-schedule-job-post">Go Back</button>
                            <button type="button" class="btn btn-primary" id="schedule-job-post-submit-button" disabled>Schedule</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--                        <div class="border schedule-block">-->
            <!--                            <h4 class="text-center">Schedule Publishing</h4>-->
            <!--                        </div>-->
            <!--                        <div class="border schedule-block">-->
            <!--                            <h4 class="text-center">Publish Now</h4>-->
            <!--                        </div>-->
            <!--                        <h4>Schedule Publishing</h4>-->
            <!--                        <div class="input-group">-->
            <!--                            <input type="text" class="form-control" placeholder="yyyy/mm/dd" id="job-post-datepicker">-->
            <!--                            <div class="input-group-append">-->
            <!--                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <hr>-->
            <!--                        <h4>Publish Now</h4>-->



<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>-->
<!--                <button type="button" class="btn btn-primary waves-effect save-draft">Save Draft</button>-->
<!--                <button type="button" class="btn btn-primary waves-effect">Post Job</button>-->
<!--            </div>-->
        </div>
    </div>
</div>
