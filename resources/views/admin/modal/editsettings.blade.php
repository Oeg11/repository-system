<div class="modal fade" id="modal-editsettings">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Settings</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="EditManuscripttypeForm" >
            <div id="mgs2" class="mx-3"></div>
         @csrf
        <div class="modal-body">

           <div class="form-group">
             <label for="status" class="control-label text-navy"><b> System Name:</b></label>
                <input type="text" class="form-control" id="edit_system_name">
                <span class="text-danger">
                    <strong id="edit_system_name-error"></strong>
                 </span>
            </div>

            <div class="form-group">
                <label for="status" class="control-label text-navy"><b> System Short Name:</b></label>
                   <input type="text" class="form-control" id="edit_system_short_name">
                   <span class="text-danger">
                       <strong id="edit_system_short_name-error"></strong>
                    </span>
               </div>

               <div class="form-group">
                <label for="status" class="control-label text-navy"><b> Description:</b></label>
                   <textarea type="text" rows="5" class="form-control" id="edit_description"></textarea>
                   <span class="text-danger">
                       <strong id="edit_description-error"></strong>
                    </span>
               </div>

               <div class="form-group">
                <label for="status" class="control-label text-navy"><b> About:</b></label>
                   <textarea type="text" rows="5" class="form-control" id="edit_about"></textarea>
                   <span class="text-danger">
                       <strong id="edit_about-error"></strong>
                    </span>
               </div>

               <div class="form-group">
                <label for="email" class="control-label text-navy"><b> Email:</b></label>
                   <input type="email" class="form-control" id="edit_email">
                   <span class="text-danger">
                       <strong id="edit_email-error"></strong>
                    </span>
               </div>

               <div class="form-group">
                <label for="status" class="control-label text-navy"><b> Contact Number:</b></label>
                   <input type="email" class="form-control" id="edit_contact_number">
                   <span class="text-danger">
                       <strong id="edit_contact_number-error"></strong>
                    </span>
               </div>


               <div class="form-group">
                <label for="status" class="control-label text-navy"><b> Adress:</b></label>
                   <input type="email" class="form-control" id="edit_address">
                   <span class="text-danger">
                       <strong id="edit_address-error"></strong>
                    </span>
               </div>

          </div>
        <div class="modal-footer justify-content-between">
            <input type="hidden" id="edit_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-editsettings">Update</button>
        </div>
       </form>
      </div>
    </div>
  </div>
