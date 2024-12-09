<div class="modal fade" id="modal-archive">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update Details</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="EditManuscripttypeForm" >
            <div id="mgs" class="mx-3"></div>
         @csrf
        <div class="modal-body">
                <input type="hidden" name="id" value="5">
                <div class="form-group">
                    <label for="status" class="control-label text-navy">Status</label>
                    <select name="status" id="edit_status" class="form-control form-control-border" required="">
                        <option value="" selected="true" disabled="disabled">Select Status</option>
                        <option value="0">Reject</option>
                        <option value="1">Approved</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status" class="control-label text-navy">Remark</label>
                      <textarea type="text" name="remark" class="form-control pk" id="edit_remark" rows="5" placeholder="Please input remark..."></textarea>
                </div>

          </div>
        <div class="modal-footer justify-content-between">
            <input type="hidden" id="edit_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-updatestatus">Update</button>
        </div>
       </form>
      </div>
    </div>
  </div>
