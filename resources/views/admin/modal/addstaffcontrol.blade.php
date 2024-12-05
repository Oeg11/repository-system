<div class="modal fade" id="modal-addstaffcontrol">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New User Control</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="AddStaff" >
            <div id="mgs_" class="mx-3"></div>
         @csrf
        <div class="modal-body">

           <div class="form-group">
             <label for="fname" class="control-label text-navy"><b>Staff:</b></label>
             <select class="form-control" id="staff_id" aria-label="Default select example">
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
                    id="collectionlist_view" value="0" aria-label="...">
                View
            </li>
            <li class="list-group-item">
                &nbsp;&nbsp;<input class="form-check-input me-1" type="checkbox"
                    id="collectionlist_updatestatus" value="0"
                aria-label="...">
                Update Status
            </li>
            <li class="list-group-item">
                &nbsp;&nbsp;<input class="form-check-input me-1" type="checkbox"
                    id="collectionlist_delete" value="0"
                     aria-label="...">
                Delete
            </li>

            </ul>


          </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-addusercontrol">Save</button>
        </div>
       </form>
      </div>
    </div>
  </div>
