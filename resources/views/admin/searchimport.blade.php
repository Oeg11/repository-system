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
                 <h2>Search Reports</h2>
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
