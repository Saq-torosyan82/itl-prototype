<div id="invite-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                <h3 class="modal-title">Invite other users to use the ITL platform.</h3>

            </div>

            <div class="modal-body">

                <form method="post" id="invite_form" action="{{route('send-invitation-letter')}}">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Email address</label>

                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                    </div>

                    <div class="form-group">

                        <label for="exampleInvitation">Invitation text</label>

                        <textarea class="form-control" id="exampleInvitation"></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>

            </div>

        </div>

    </div>

</div>