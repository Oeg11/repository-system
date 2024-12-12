@extends('admin.alayouts.main')
@section('content')


<div class="content-wrapper">
  <div id="loader"></div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- <h1>Dashboard</h1> --}}
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
              {{-- <li class="breadcrumb-item">Dashboard</li> --}}
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">

                <form method="POST" enctype="multipart/form-data">
                    <div id="mgs2____"></div>
                    @csrf

                    <div class="row g-1">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="file" name="import_file" id="import_file" accept=".csv, .xlsx"  class="form-control">

                            </div>
                            <span class="text-danger">
                                <strong id="import_file-error"></strong>
                             </span>
                        </div>

                        <div class="col-md-2">
                            <div class="input-group">
                             <button type="button" class="btn btn-primary" id="btn-importcsv">Import CSV</button>

                            </div>
                        </div>

                    </div>

                  </form>
                  <hr>
                <div class="row">
                    <div class="col-md-10"><h4>Import users by uploading excel or CSV file</h4></div>
                    <div class="col-md-2">  <a class="btn btn-warning float-end" class="btn btn-success" href="{{ route('admin.exportexcel') }}">Export User Data</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-hover data-table3">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th id="columnHeader">Password</th>
                            <th scope="col">Department</th>
                            <th scope="col">Curriculum</th>
                            <th scope="col">Role</th>
                            <th id="columnHeader">Status</th>

                        </tr>
                    </thead>
                     <tbody>
                        @foreach ($students as $row)
                        <tr>
                              <td>{{ $row->id  }}</td>
                              <td>{{ $row->fullname  }}</td>
                              <td>{{ $row->email  }}</td>
                              <td id="columnData">{{ $row->password  }}</td>
                              <td>{{ $row->department_id  }}</td>
                              <td>{{ $row->curriculum_id  }}</td>
                              <td>{{ $row->role  }}</td>
                              <td id="columnData">{{ $row->status  }}</td>

                          </tr>
                          @endforeach
                    </tbody>
                </table>
              </div>
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


  @endsection
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        $('#columnHeader').hide();
        $('#columnData').hide();
    });
</script>

  <script type="text/javascript">

    $(document).ready(function(){

        var table = $('.data-table3').DataTable({

        });

    });

</script>

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


                  var data = new FormData(this.form);

                  data.append('import_file', $('#import_file')[0].files[0]);

                  $.ajax({
                        url: '{{ route("admin.useraddingcsv") }}',
                        method: 'post',
                        data:data,
                        cache:false,
                        contentType: false,
                        processData: false,

                      success: function(response){
                        console.log(response);

                            if(response.errors) {
                                if(response.errors.import_file){
                                    $('#import_file-error').html(response.errors.import_file[0]);
                                }

                            }

                          // console.log(response.status == "Success");
                          if(response.status == 200){

                             $('#mgs2____').html('<div class="alert alert-success">CSX imported successfully!</div>');
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
