<div class="modal fade" id="modal-addcurriculum">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">New Curriculum</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="EditManuscripttypeForm" >
            <div id="mgs" class="mx-3"></div>
         @csrf
        <div class="modal-body">

          <div class="form-group">
            <label for="status" class="control-label text-navy"><b> Department:</b></label>
            <select class="form-control" name="department_id" id="department_id" placeholder="Select Department">
                <option value="" selected="true" disabled="disabled">Select Department</option>
            @foreach ($departments as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
            @endforeach
            </select>
            <span class="text-danger">
                <strong id="department_id-error"></strong>
             </span>
        </div>


           <div class="form-group">
             <label for="status" class="control-label text-navy"><b> Name:</b></label>
                <input type="text" class="form-control" id="name">
                <span class="text-danger">
                    <strong id="name-error"></strong>
                 </span>
            </div>

            <div class="form-group">
                <label for="status" class="control-label text-navy"><b>Description:</b></label>
                  <textarea type="text" rows="5" class="form-control" id="description" ></textarea>
                  <span class="text-danger">
                    <strong id="description-error"></strong>
                 </span>
               </div>

          </div>
        <div class="modal-footer justify-content-between">
            <input type="hidden" id="edit_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-addcurriculum">Save</button>
        </div>
       </form>
      </div>
    </div>
  </div>
