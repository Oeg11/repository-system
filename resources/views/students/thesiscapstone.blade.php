@extends('students.slayouts.main')
@section('content')

    <div class=" mt-4">
  <dv id="loader"></dv>
   <div class="row">

    <div class="col-md-3"></div>
    <div class="col-md-7">

        <div class="card" style="border-top:2px solid #007bff;margin-top:5%">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                               <label><b>Project Title</b></label>
                                 <input type="text" id="title" name="title" class="form-control form-control-lg">
                              </div>
                              <span id="title-error" class="text-danger"></span>
                        </div>
                   </div>

                   <div class="row mt-3">
                    <div class="col-md-6">
                       <div class="form-group">
                           <label><b>Type</b></label>
                             <select class="form-control form-control-lg" id="type" name="type" aria-label="Default select example">
                                <option value="" selected="true" disabled="disabled">&larr; Select Type &rarr;</option>
                                <option value="Capstone 2">Capstone 2</option>
                                <option value="CS Thesis 2">CS Thesis 2</option>
                                <option value="SHS Practical Research">SHS Practical Research</option>
                                <option value="BSTM Thesis">BSTM Thesis</option>
                           </select>
                          </div>
                          <span id="type-error" class="text-danger"></span>
                    </div>
               </div>

               <div class="row mt-3">
                <div class="col-md-6">
                   <div class="form-group">
                       <label><b>Category</b></label>
                         <select class="form-control form-control-lg" id="category" name="category" aria-label="Default select example">
                            <option value="" selected="true" disabled="disabled">&larr; Select Category &rarr;</option>
                          <option value="Web Application">Web Application</option>
                          <option value="Mobile Application">Mobile Application</option>
                          <option value="PC Application">PC Application</option>
                          <option value="Standalone Application">Standalone Application</option>
                       </select>
                      </div>
                      <span id="category-error" class="text-danger"></span>
                </div>
            </div>

                   <div class="row mt-3">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Department</b></label>
                                <select class="form-control form-control-lg" name="department_id" id="department_id" placeholder="Select Department">
                                    <option value="" selected="true" disabled="disabled">Select Department</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach

                                </select>
                                <span id="department_id-error" class="text-danger"></span>
                            </div>
                    </div>
                   </div>

           <div class="row mt-3">
            <div class="col-md-6">
               <div class="form-group">
                   <label><b>Curriculum</b></label>
                    <select class="form-control form-control-lg" name="curriculum_id" id="curriculum_id" placeholder="Select Curriculum">
                        <option value="" selected="true" disabled="disabled">Select Curriculum</option>
                        @foreach ($curriculums as $curr)
                         <option value="{{ $curr->id }}">{{ $curr->name }}</option>
                      @endforeach
                    </select>
                    <span id="curriculum_id-error" class="text-danger"></span>
                </div>
           </div>
           </div>


                <div class="row mt-3">
                    <div class="col-md-6">
                       <div class="form-group">
                           <label><b>Year</b></label>
                             <select class="form-control form-control-lg" id="year" name="year" aria-label="Default select example">
                                <option value="" selected="true" disabled="disabled">&larr; Select year &rarr;</option>
                                @php
                                   for($i=2010;$i<=date('Y');$i++) {
                                            echo '<option value='.$i.'>'.$i.'</option>';
                                            if($i == '2030'){break;}
                                        }

                                @endphp
                           </select>
                          </div>
                          <span id="year-error" class="text-danger"></span>
                    </div>
               </div>


               <div class="row mt-3">
                <div class="col-md-12">
                   <div class="form-group">
                       <label><b>Abstract</b></label>
                       <textarea class="form-control" id="editor1" name="members"></textarea>
                       <textarea id="editor_details1" hidden></textarea>
                        {{-- <textarea rows="5" id="abstract" name="abstract" class="form-control form-control-lg"> </textarea> --}}
                      </div>
                      <span id="abstract-error" class="text-danger"></span>
                  </div>
              </div>


              <div class="row mt-3">
                <div class="col-md-12">
                   <div class="form-group">
                       <label><b>Authors</b></label>
                       <textarea class="form-control" id="editor2" name="members"></textarea>
                       <textarea id="editor_details2" hidden></textarea>
                        {{-- <textarea rows="5" id="members" name="members" class="form-control form-control-lg"> </textarea> --}}
                      </div>
                      <span id="members-error" class="text-danger"></span>
                  </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                       <label><b>Adviser</b></label>
                         <input type="text" id="adviser" name="adviser" class="form-control form-control-lg">
                      </div>
                      <span id="adviser-error" class="text-danger"></span>
                </div>
           </div>

           <div class="row">
            <div class="mb-3 col-md-12">
                <label for="exampleFormControlInput1" class="form-label">Project Image</label>
                <div class="preview" style="border:1px solid #5f6265;background-color:#5f6265">
                    <center> <img class="center" id="file-ip-1-preview" src="{{asset('assets/img/no-image-available.png')}}" style="height:150px;width:200px"></center>
                </div>
                <input type="file" class="mt-2"  id="file-ip-1" name="thesis_image" accept="image/*" onchange="showPreview1(event);">
                <span id="banner_path-error" class="text-danger"></span>
            </div>
            </div>

              {{-- <div class="row mt-3">
                <div class="col-md-12">
                   <div class="form-group">
                       <label><b>Project Image/Banner Image</b></label>
                         <input type="file" class="form-control form-control-lg" id="banner_path" name="banner_path" accept=".jpg, .png, jpeg, JPEG">
                           <center><p style="border:1px solid black;width:100%;background: #343a40 linear-gradient(180deg, #52585d, #343a40) repeat-x !important;:"><img src="{{asset('assets/img/no-image-available.png')}}" height="300px" width="300px"></p ></center>
                      </div>
                      <span id="banner_path-error" class="text-danger"></span>
                </div>
             </div> --}}


             <div class="row mt-3">
                <div class="col-md-6">
                   <div class="form-group">
                       <label><b>Project Document (PDF File Only)</b></label>
                         <input type="file" id="document_path" name="document_path" class="form-control form-control-lg " accept=".pdf">
                      </div>
                      <span id="document_path-error" class="text-danger"></span>
                </div>
             </div>

             <div class="row mt-3">
                <div class="col-md-6">
                   <div class="form-group">
                         <input type="checkbox" id="click_checkbox" value="true" data-toggle="modal" data-target="#termandprivacy" /> <b>I agree to the terms and privacy policy.</b>

                      </div>
                      <span id="check-error" class="text-danger"></span>
                </div>
            </div>

             <div class="row mt-3">
                <div class="col-md-12">
                   <div class="form-group">
                    <input type="hidden" id="student_foreign_id" name="student_foreign_id" value="{{ Auth::user()->id }}">
                       <button type="button" class="btn btn-outline-primary" id="btn-submit">Submit</button>
                      </div>
                </div>
             </div>

                </form>
            </div>
          </div>
    </div>
   </div>

    </div>

      @include('students.modal.termandprivacy')

    @endsection

    <script>
        $(document).ready(function(){
                ​$("#click_checkbox").on("change", function(e){
                    if(e.target.checked){
                    $('#termandprivacy').modal();
                }
                });

            });
    </script>

