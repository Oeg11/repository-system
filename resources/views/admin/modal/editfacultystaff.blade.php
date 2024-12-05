<div class="modal fade" id="modal-editfacultystaff">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Faculty/Staff</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="EditManuscripttypeForm" >
            <div id="mgs2" class="mx-3"></div>
         @csrf
        <div class="modal-body">

           <div class="form-group">
             <label for="status" class="control-label text-navy"><b> First Name:</b></label>
                <input type="text" class="form-control" id="edit_firstname">
                <span class="text-danger">
                    <strong id="edit_firstname-error"></strong>
                 </span>
            </div>

            <div class="form-group">
                <label for="status" class="control-label text-navy"><b> Middle Name:</b></label>
                   <input type="text" class="form-control" id="edit_middlename">
                   <span class="text-danger">
                       <strong id="edit_middlename-error"></strong>
                    </span>
               </div>

               <div class="form-group">
                <label for="status" class="control-label text-navy"><b> Last Name:</b></label>
                   <input type="text" class="form-control" id="edit_lastname">
                   <span class="text-danger">
                       <strong id="edit_lastname-error"></strong>
                    </span>
               </div>

               <div class="form-group">
                <label for="status" class="control-label text-navy"><b> Email:</b></label>
                   <input type="email" class="form-control" id="edit_email">
                   <span class="text-danger">
                       <strong id="edit_email-error"></strong>
                    </span>
               </div>

               <div class="form-group">
                <label for="status" class="control-label text-navy"><b> Status:</b></label>
                <select class="form-control"  id="edit_status" placeholder="Select Department">
                    <option value="" selected="true" disabled="disabled">Select Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">In Active</option>
                </select>
                <span class="text-danger">
                    <strong id="edit_status-error"></strong>
                 </span>
            </div>



          </div>
        <div class="modal-footer justify-content-between">
            <input type="hidden" id="edit_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-editfstaff">Update</button>
        </div>
       </form>
      </div>
    </div>
  </div>
