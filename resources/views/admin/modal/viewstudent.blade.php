<div class="modal fade" id="modal-viewstudent">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Details</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="EditManuscripttypeForm" >
            <div id="mgs" class="mx-3"></div>
         @csrf
        <div class="modal-body">

           <div class="form-group">
             <label for="status" class="control-label text-navy"><b>Student Name:</b></label>
                <input type="text" class="form-control" id="view_fullname" disabled="disabled">
            </div>

            <div class="form-group">
                <label for="status" class="control-label text-navy"><b>Email:</b></label>
                   <input type="text" class="form-control" id="view_email" disabled="disabled">
               </div>

               {{-- <div class="form-group">
                <label for="status" class="control-label text-navy"><b>Curriculum:</b></label>
                   <input type="text" class="form-control" id="view_curriculum_name" disabled="disabled">
               </div>

               <div class="form-group">
                <label for="status" class="control-label text-navy"><b>Department:</b></label>
                   <input type="text" class="form-control" id="view_department_name" disabled="disabled">
               </div> --}}

               {{-- <div class="form-group">
                <label for="status" class="control-label text-navy"><b>Account Status:</b></label>
                  <div id="view_status"></div>
               </div> --}}

          </div>
        <div class="modal-footer justify-content-between">
            <input type="hidden" id="edit_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
       </form>
      </div>
    </div>
  </div>
