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
                        <option value="1">Approved</option>
                        <option value="0">Reject</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status" class="control-label text-navy">Status</label>
                      <textarea type="text" name="remark" class="form-control" id="remark" rows="5" placeholder="Please input remark..."></textarea>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">



    <script>

        $(document).ready(function(){
        $("#edit_status").change(function() {
            if($(this).val() == 0){

                $("#remark").css('display', 'block');

            }else{
                $("#remark").css('display', 'none');
            }
         });
        });


</script>


