<div class="modal fade" id="modal-viewarchive">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">View Details</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


            <div class="card-body ">

        <form method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                       <label><b>Project Title</b></label>
                         <input type="text" id="view_title" name="title" class="form-control" disabled="disabled">
                      </div>
                      <span id="title-error" class="text-danger"></span>
                </div>
           </div>

            <div class="row mt-3">
                <div class="col-md-6">
                   <div class="form-group">
                       <label><b>Category</b></label>
                       <input type="text" id="view_category" name="title" class="form-control" disabled="disabled">
                      </div>
                      <span id="category-error" class="text-danger"></span>
                </div>
           </div>

           <div class="row mt-3">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label><b>Department</b></label>
                            <input type="text" id="view_department2" name="title" class="form-control" disabled="disabled">

                        </select>
                        <span id="department_id-error" class="text-danger"></span>
                    </div>
            </div>
           </div>

   <div class="row mt-3">
    <div class="col-md-6">
       <div class="form-group">
           <label><b>Curriculum</b></label>
           <input type="text" id="view_curriculum2" name="title" class="form-control" disabled="disabled">
            <span id="curriculum_id-error" class="text-danger"></span>
        </div>
   </div>
   </div>


        <div class="row mt-3">
            <div class="col-md-6">
               <div class="form-group">
                   <label><b>Year</b></label>
                      <input type="text" id="view_year" name="title" class="form-control" disabled="disabled">
                  </div>
                  <span id="year-error" class="text-danger"></span>
            </div>
       </div>


       <div class="row mt-3">
        <div class="col-md-12">
           <div class="form-group">
               <label><b>Abstract</b></label>
               <textarea class="form-control _abstract" id="" name="members" disabled="disabled"></textarea>
               {{-- <textarea id="editor_details1" hidden></textarea> --}}
                {{-- <textarea rows="5" id="abstract" name="abstract" class="form-control"> </textarea> --}}
              </div>
              <span id="abstract-error" class="text-danger"></span>
          </div>
      </div>


      <div class="row mt-3">
        <div class="col-md-12">
           <div class="form-group">
               <label><b>Authors</b></label>
               <textarea class="form-control _members" name="members" disabled="disabled"></textarea>
               <textarea id="editor_details2" hidden></textarea>
                {{-- <textarea rows="5" id="members" name="members" class="form-control"> </textarea> --}}
              </div>
              <span id="members-error" class="text-danger"></span>
          </div>
      </div>

      <div class="row">
        <div class="col-md-6">
           <div class="form-group">
               <label><b>Adviser</b></label>
                 <input type="text" id="view_adviser" name="adviser" class="form-control" disabled="disabled">
              </div>
              <span id="adviser-error" class="text-danger"></span>
        </div>
   </div>

   <div class="row">
    <div class="col-md-6">
       <div class="form-group">
           <label><b>Thesis Coordinator</b></label>
             <input type="text" id="view_thesis_coordinator" name="thesis_coordinator" class="form-control" disabled="disabled">
          </div>
          <span id="thesis_coordinator-error" class="text-danger"></span>
    </div>
</div>

   <div class="row">
    <div class="mb-3 col-md-12">
        <label for="exampleFormControlInput1" class="form-label">Thesis Image</label>
        <div class="preview" style="border:1px solid #5f6265;background-color:#5f6265">
            <center> <img class="center" id="view_abanner_path" src="" style="height:150px;width:200px"></center>
        </div>
        {{-- <input type="file" class="mt-2"  id="file-ip-1" name="thesis_image" accept="image/*" onchange="showPreview1(event);">
        <span id="banner_path-error" class="text-danger"></span> --}}
    </div>
    </div>

      {{-- <div class="row mt-3">
        <div class="col-md-12">
           <div class="form-group">
               <label><b>Project Image/Banner Image</b></label>
                 <input type="file" class="form-control" id="banner_path" name="banner_path" accept=".jpg, .png, jpeg, JPEG">
                   <center><p style="border:1px solid black;width:100%;background: #343a40 linear-gradient(180deg, #52585d, #343a40) repeat-x !important;:"><img src="{{asset('assets/img/no-image-available.png')}}" height="300px" width="300px"></p ></center>
              </div>
              <span id="banner_path-error" class="text-danger"></span>
        </div>
     </div> --}}


     <div class="row mt-3">
        <div class="col-md-6">
           <div class="form-group">
               <label><b>Project Document (PDF File Only)</b></label><br>
                 {{-- <input type="file" id="document_path" name="document_path" class="form-control " accept=".pdf"> --}}
               <p id="view_document_path" style="color:red"></p>
              </div>
              <span id="document_path-error" class="text-danger"></span>
        </div>
     </div>


          </div>
        <div class="modal-footer justify-content-between">
            <input type="hidden" id="edit_id">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
       </form>
      </div>
    </div>
  </div>
