@extends('admin.alayouts.main')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
              <li class="breadcrumb-item active">Dashboard</li>
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
                <h3>{{$countprojects }}</h3>

                <p>Capstone 2</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="{{ route('admin.viewproject') }}" class="small-box-footer">View Capstone 2 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$countresearch }}</h3>

                <p>CS Thesis 2</p>
              </div>
              <div class="icon">
                <i class="fas fa-search"></i>
              </div>
              <a href="{{ route('admin.viewresearch') }}" class="small-box-footer">View CS Thesis 2 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="text-light">{{$countthesisCapstone}}</h3>

                <p class="text-light">SHS Practical Research</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-open"></i>
              </div>
              <a href="{{ route('admin.viewcapstonethesis') }}" class="small-box-footer"><font color="white">View SHS Practical Research </font> <i class="fas fa-arrow-circle-right text-light"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$counttotalProjects}}</h3>

                <p>BSTM Thesis</p>
              </div>
              <div class="icon">
                <i class="fas fa-file"></i>
              </div>
              <a href="{{ route('admin.viewtotalprojects') }}" class="small-box-footer">View BSTM Thesis <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>



        {{-- <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ $countdepartment }}</h3>

                  <p>Capstone 2</p>
                </div>
                <div class="icon">
                  <i class="fa fa-list"></i>
                </div>
                <a href="{{route('admin.departmentlist')}}" class="small-box-footer">View Department <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ $countcurriculum  }}</h3>

                  <p>CS Thesis 2</p>
                </div>
                <div class="icon">
                  <i class="fas fa-scroll"></i>
                </div>
                <a href="{{route('admin.curriculumlist')}}" class="small-box-footer">View Curriculum <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3 class="text-light">{{ $verifiedarchive }}</h3>

                  <p class="text-light">SHS Practical Research</p>
                </div>
                <div class="icon">
                  <i class="fas fa-check"></i>
                </div>
                <a href="{{ route('admin.viewverifiedarchive') }}" class="small-box-footer"><font color="white">View Verified Projects </font> <i class="fas fa-arrow-circle-right text-light"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ $verifiednotarchive }}</h3>

                  <p>BSTM Thesis</p>
                </div>
                <div class="icon">
                  <i class="fas fa-times"></i>
                </div>
                <a href="{{ route('admin.viewnotverifiedarchive') }}" class="small-box-footer">View Unverified Projects <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div> --}}
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
