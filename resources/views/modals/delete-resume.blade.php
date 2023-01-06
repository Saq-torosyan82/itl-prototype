<div id="delete-resume-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content pb-1">

            <div class="modal-body pt-2">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <h5>Delete The Following Resume?</h5>
                        <p class="name-resume">Test Name</p>
                        <form method="POST" action="">
                            @csrf
                            <input type="hidden" id="resume-hidden-input" name="resume" value="">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-danger" type="submit">Delete Resume</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

