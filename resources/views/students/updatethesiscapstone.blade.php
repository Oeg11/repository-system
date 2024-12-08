@extends('students.slayouts.main')
@section('content')
<div id="loader"></div>
    <div class=" mt-4">

   <div class="row">

    <div class="col-md-3"></div>
    <div class="col-md-7">

        <div class="card" style="border-top:2px solid #007bff">
            <div class="card-body">

        @foreach ($uthesiscapstone as $ct)

                <form method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                               <label><b>Project Title</b></label>
                                 <input type="text" id="edit_title" name="title" value="{{$ct->title}}" class="form-control form-control-lg">
                              </div>
                              <span id="title-error" class="text-danger"></span>
                        </div>
                   </div>

                   <div class="row mt-3">
                    <div class="col-md-6">
                       <div class="form-group">
                           <label><b>Type</b></label>
                             <select class="form-control form-control-lg" id="edit_type" name="type" value="{{$ct->MyType}}" aria-label="Default select example">
                            <option value="" selected="true" disabled="disabled">&larr; Select Type &rarr;</option>

                              <option value="Capstone 2" @if ($ct->MyType == "Capstone 2") {{ 'selected' }} @endif>Capstone 2</option>
                              <option value="CS Thesis 2" @if ($ct->MyType == "CS Thesis 2") {{ 'selected' }} @endif>CS Thesis 2</option>
                              <option value="SHS Practical Research" @if ($ct->MyType == "SHS Practical Research") {{ 'selected' }} @endif>SHS Practical Research</option>
                              <option value="BSTM Thesis" @if ($ct->MyType == "BSTM Thesis") {{ 'selected' }} @endif>BSTM Thesis</option>

                           </select>


                          </div>
                          <span id="type-error" class="text-danger"></span>
                    </div>
                </div>


               <div class="row mt-3">
                <div class="col-md-6">
                   <div class="form-group">
                       <label><b>Category</b></label>
                         <select class="form-control form-control-lg" id="edit_category" name="category" aria-label="Default select example">
                            <option value="" selected="true" disabled="disabled">&larr; Select Category &rarr;</option>

                            <option value="Web Application" @if ($ct->category == "Web Application") {{ 'selected' }} @endif>Web Application</option>
                            <option value="Mobile Application" @if ($ct->category == "Mobile Application") {{ 'selected' }} @endif>Mobile Application</option>
                            <option value="PC Application" @if ($ct->category == "PC Application") {{ 'selected' }} @endif>PC Application</option>
                            <option value="Standalone Application" @if ($ct->category == "Standalone Application") {{ 'selected' }} @endif>Standalone Application</option>

                       </select>
                      </div>
                      <span id="category-error" class="text-danger"></span>
                </div>
           </div>

                   <div class="row mt-3">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label><b>Department</b></label>
                                <select class="form-control form-control-lg" name="department_id" value="{{$ct->department_id}}" id="edit_department_id" placeholder="Select Department">
                                    <option value="" selected="true" disabled="disabled">&larr; Select Department &rarr;</option>

                                @foreach($departments as $dept)
                                  <option value="{{ $dept->id }}" {{ (collect($ct->department_id)->contains($dept->id)) ? 'selected':'' }}>{{ $dept->name }}</option>
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
                    <select class="form-control form-control-lg" name="curriculum_id" value="{{$ct->curriculum_id}}" id="edit_curriculum_id" placeholder="Select Curriculum">
                        <option value="" selected="true" disabled="disabled">&larr; Select Curriculum &rarr;</option>
                        @foreach ($curriculums as $curr)
                         <option value="{{ $curr->id }}" {{ (collect($ct->curriculum_id)->contains($curr->id)) ? 'selected':'' }}>{{ $curr->name }}</option>
                      @endforeach
                    </select>
                    <span id="curriculum_id-error" class="text-danger"></span>
                </div>
           </div>
           </div>



               <div class="row mt-3">
                <div class="col-md-6">
                   <div class="form-group">
                        <select id="edit_year" name="year" class="form-control form-control-lg" value="{{$ct->year}}">
                            <option value="" selected="true" disabled="disabled">&larr; Select year &rarr;</option>
                            <?php
                                $year_start  = 2010;
                                $year_end = date('Y');
                                $selected_year = 2024;

                                for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {
                                    $selected = $ct->year == $i_year ? ' selected' : '';
                                    echo '<option value="'.$i_year.'"'.$selected.'>'.$i_year.'</option>'."\n";
                                }
                            ?>
                            </select>
                        </div>
                        <span id="year-error" class="text-danger"></span>
                </div>
            </div>


               <div class="row mt-3">
                <div class="col-md-12">
                   <div class="form-group">
                       <label><b>Abstract</b></label>
                       <textarea class="form-control" id="edit_editor1" name="abstract" > {!!  html_entity_decode(ucwords($ct->abstract)) !!}</textarea>
                       <textarea id="edit_editor_details1" hidden></textarea>
                        {{-- <textarea rows="5" id="abstract" name="abstract" class="form-control form-control-lg"> </textarea> --}}
                      </div>
                      <span id="abstract-error" class="text-danger"></span>
                  </div>
              </div>


              <div class="row mt-3">
                <div class="col-md-12">
                   <div class="form-group">
                       <label><b>Project Members</b></label>
                       <textarea class="form-control" id="edit_editor2" name="members">{!!  html_entity_decode(ucwords($ct->members)) !!}</textarea>
                       <textarea id="edit_editor_details2" hidden></textarea>
                        {{-- <textarea rows="5" id="members" name="members" class="form-control form-control-lg"> </textarea> --}}
                      </div>
                      <span id="members-error" class="text-danger"></span>
                  </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                       <label><b>Adviser</b></label>
                         <input type="text" id="edit_adviser" name="adviser" value="{{$ct->adviser}}" class="form-control form-control-lg">
                      </div>
                      <span id="adviser-error" class="text-danger"></span>
                </div>
           </div>

           <div class="row">
            <div class="mb-3 col-md-12">
                <label for="exampleFormControlInput1" class="form-label">Thesis Image</label>
                <div class="preview" style="border:1px solid #5f6265;background-color:#5f6265">
                    <center> <img class="center" id="edit_file-ip-1-preview" src="{{ $ct->banner_path ? asset('storage/uploads/'.$ct->banner_path) : asset('assets/img/no-image-available.png') }}" style="height:150px;width:200px"></center>
                </div>
                <input type="file" class="mt-2"  id="add_file-ip-1"  name="thesis_image" accept="image/*" onchange="showPreview(event);">
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
                         <input type="file" id="add_document_path" name="document_path" value="{{$ct->document_path}}" class="form-control form-control-lg " accept=".pdf">
                         <a href="{{asset('storage/uploads/'.$ct->document_path)}}" download=""><font color="black">Preview Document:</font> {{$ct->document_path}}</a>
                      </div>
                      <span id="document_path-error" class="text-danger"></span>
                </div>
             </div>



             <div class="row mt-3">
                <div class="col-md-12">
                   <div class="form-group">
                    <input type="hidden" id="id" name="id" value="{{ $ct->archives_id}}">
                    <input type="text" id="edit_student_foreign_id" name="student_id" value="{{ Auth::user()->id }}">

                    <input type="hidden" id="edit_banner_path" name="edit_banner_path" value="{{$ct->banner_path}}">
                    <input type="hidden" id="edit_document_path" name="document_path" value="{{$ct->document_path}}">


                       <button type="button" class="btn btn-outline-primary" id="btn-updateProject">Update</button>
                      </div>
                </div>
             </div>

                </form>


        @endforeach


            </div>
          </div>
    </div>
   </div>

    </div>

    @endsection

