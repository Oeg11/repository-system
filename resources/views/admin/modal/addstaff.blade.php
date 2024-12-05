<div class="modal fade" id="modal-addstaff">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Staff</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="AddStaff" >
            <div id="mgs" class="mx-3"></div>
         @csrf
        <div class="modal-body">

           <div class="form-group">
             <label for="fname" class="control-label text-navy"><b>First Name:</b></label>
                <input type="text" class="form-control" id="firstname">
                <span class="text-danger">
                    <strong id="firstname-error"></strong>
                 </span>
            </div>

            <div class="form-group">
                <label for="mname" class="control-label text-navy"><b>Middle Name:</b></label>
                   <input type="text" class="form-control" id="middlename" placeholder="Optional">
                   <span class="text-danger">
                       <strong id="middlename-error"></strong>
                    </span>
               </div>

               <div class="form-group">
                <label for="lname" class="control-label text-navy"><b>Last Name:</b></label>
                   <input type="text" class="form-control" id="lastname">
                   <span class="text-danger">
                       <strong id="lastname-error"></strong>
                    </span>
               </div>

               <div class="form-group">
                <label for="status" class="control-label text-navy"><b>Email:</b></label>
                   <input type="text" class="form-control" id="email">
                   <span class="text-danger">
                       <strong id="email-error"></strong>
                    </span>
               </div>

               <div class="form-group">
                <label for="status" class="control-label text-navy"><b>Password:</b></label>
                   <input type="text" class="form-control" id="password">
                   <span class="text-danger">
                       <strong id="password-error"></strong>
                    </span>
               </div>



          </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-addStaff">Save</button>
        </div>
       </form>
      </div>
    </div>
  </div>
