<div class="modal fade" id="termandprivacy">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Term And Privacy</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="EditManuscripttypeForm" >
            <div id="mgs" class="mx-3"></div>
         @csrf
        <div class="modal-body">
             <p>
                 <h5><b>Privacy Policy</b></h5>
                <ul>
                    <li>Purpose of the policy and commitment to protecting user privacy.</li>
                    <li>Contact details for privacy-related inquiries.</li>
                  </ul>
             <p>

          </div>
        <div class="modal-footer justify-content-between">
            <input type="hidden" id="edit_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {{-- <button type="button" class="btn btn-primary" id="btn-adddepartment">Save</button> --}}
        </div>
       </form>
      </div>
    </div>
  </div>
