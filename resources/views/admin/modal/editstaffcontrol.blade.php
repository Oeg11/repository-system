<div class="modal fade" id="modal-editstaffcontrol">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit User Control</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="AddStaff" >
            <div id="mgs__" class="mx-3"></div>
         @csrf
        <div class="modal-body">

           <div class="form-group">
             <label for="fname" class="control-label text-navy"><b>Staff:</b></label>
             <select class="form-control" id="edit_staff_id" aria-label="Default select example">
                <option selected="true" disabled="disabled"> &larr; Select Staff &rarr;</option>
                @foreach ($staffs as $row)
                <option value="{{  $row->id }}">{{ $row->firstname .' '. $row->lastname }}</option>
                @endforeach
            </select>
                <span class="text-danger">
                    <strong id="staff_id-error"></strong>
                 </span>
            </div>

            <ul class="list-group">

            <li class="list-group-item">

                &nbsp;&nbsp;<input class="form-check-input me-1" type="checkbox"
                    id="edit_views"  aria-label="...">
                View
            </li>
            <li class="list-group-item">
                &nbsp;&nbsp;<input class="form-check-input me-1" type="checkbox"
                    id="edit_ustatus"
                aria-label="...">
                Update Status
            </li>
            <li class="list-group-item">
                &nbsp;&nbsp;<input class="form-check-input me-1" type="checkbox"
                    id="edit_delete"
                     aria-label="...">
                Delete
            </li>

            </ul>


          </div>
        <div class="modal-footer justify-content-between">
            <input type="hidden" class="form-control" id="id">

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-editusercontrol">Update</button>
        </div>
       </form>
      </div>
    </div>
  </div>
