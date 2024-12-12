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
                <div class="row">
                    <div class=col-md-9><h2><b>Type Reports</b></h2></div>
                    {{-- <div class="col-md-3">  <a class="btn btn-warning float-end" class="btn btn-success" href="{{ route('admin.exporttype') }}">Download Type Report</a> --}}
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <form method="POST">
                <div class="row d-flex">
                                <div class="col-md-3">
                                    <label for="country">Type</label>
                                    <select class="form-control" id="type">
                                        @foreach ($types as $row)
                                            <option value="{{ $row->type }}">{{ $row->type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            <div class="col-md-3">
                                <label for="From">From</label>
                                <input type="date" class="form-control date1" />
                            </div>
                            <div class="col-md-3">
                                <label for="To">To</label>
                                <input type="date"  class="form-control date2" />
                            </div>
                            <div class="col-md-3" style="margin-top:3%">
                                <label  style="color:white">x</label>
                                <button type="button" class="btn btn-primary" id="btn_search">Filter</button>
                            </div>
                        </div>
                    </form>

                    <hr>


                    <div class="table-responsive">
                        <table class="table mt-3 table-striped table-sm gradelevel-datatable">
                            {{-- <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Student Number</th>
                                    <th>RFID Number</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Time Duration</th>
                                    <th>Log Date</th>
                                    <th>Grade Level Name</th>
                                    <th>Section Name</th>
                                </tr>
                            </thead> --}}
                            <tbody id="load_data" class="table-data">
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


  <script>
    $(document).ready(function() {
        load_data();
        var count = 1;
        function load_data() {
            $(document).on('click', '.btn-click', function() {

                       var type = $('#type').val();
                       var date1 = $('#date1').val();
                       var date2 = $('#date2').val();

                    $.ajaxSetup({
                      headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });

                //   $.ajax({
                //         type: 'GET',
                //         url: '{{ route('reports.attendance_reports') }}',
                //         data: {
                //         type: type,
                //           date1: date1,
                //           date2: date2
                //         },
                //         xhrFields: {
                //             responseType: 'blob'
                //         },
                //         success: function(response){
                //           var blob = new Blob([response]);
                //           var link = document.createElement('a');
                //           link.href = window.URL.createObjectURL(blob);
                //           link.download = "attendance_reports.pdf";
                //           link.click();
                //       }, error: function(blob){
                //             console.log(blob);
                //         }

                //   })

            });
         }

    });

  </script>
