@extends('admin.alayouts.main')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Import users by uploading excel file</h4>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div id="mgs2"></div>
                        @csrf

                        <div class="row g-1">
                            <div class="col-md-10">
                                <div class="input-group">
                                    <input type="file" name="import_file" accept=".csv" id="import_file" class="form-control">

                                </div>
                                <span class="text-danger">
                                    <strong id="import_file-error"></strong>
                                 </span>
                            </div>

                            <div class="col-md-2">
                                <div class="input-group">
                                    <button type="button" class="btn btn-primary" id="btn-importcsv">Import</button>
                                </div>
                            </div>

                        </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

  @endsection
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


  <script type="text/javascript">

    $(document).ready(function(){


            //edit edit password
            $('body').on('click', '#btn-importcsv', function(e){

                  e.preventDefault();
                  $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });

                 $('#import_file-error').html("");


                  let import_file = $('#import_file').val();
                  console.log(import_file);


                  $.ajax({
                      url: '{{ route("admin.useraddingcsv") }}',
                      method: 'post',
                      data: {
                          import_file: import_file,
                      },
                      success: function(response){
                        console.log(response);
                            if(response.errors) {
                                if(response.errors.import_file){
                                    $('#import_file-error').html(response.errors.import_file[0]);
                                }


                            }

                          // console.log(response.status == "Success");
                          if(response.status == 200){

                             $('#mgs2').html('<div class="alert alert-success">CSX imported successfully!</div>');
                               setTimeout(function(){
                                  window.location.reload();
                              }, 2000);
                      }
                      if(response.errors) {
                          console.log("Failed");

                      }

                  },
               });
            });
           //end edit password




      });

    </script>
