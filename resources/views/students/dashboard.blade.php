@extends('students.slayouts.main')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div id="loader"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$capstone2 }}</h3>

                <p>Capstone 2</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="{{ route('student.viewproject') }}" class="small-box-footer">View Capstone 2 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$csthesis2 }}</h3>

                <p>CS Thesis 2</p>
              </div>
              <div class="icon">
                <i class="fas fa-scroll"></i>
              </div>
              <a href="{{ route('student.viewresearch') }}" class="small-box-footer">View CS Thesis 2 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="text-light">{{$shspracticalresearch}}</h3>

                <p class="text-light">SHS Practical Research</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-open"></i>
              </div>
              <a href="{{ route('student.viewcapstonethesis') }}" class="small-box-footer"><font color="white">View SHS Practical Research </font> <i class="fas fa-arrow-circle-right text-light"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$bstmthesis}}</h3>

                <p>BSTM Thesis</p>
              </div>
              <div class="icon">
                <i class="fas fa-archive"></i>
              </div>
              <a href="{{ route('student.viewtotalprojects') }}" class="small-box-footer">View BSTM Thesis <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
