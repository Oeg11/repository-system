@extends('admin.alayouts.main')
@section('content')


<div class="content-wrapper">
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
                 <h2>Analytic Reports</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">


                <div id="container" style="width: 75%;">
                    <canvas id="canvas"></canvas>
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
  <script src="http://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script>
  <script src="http://www.chartjs.org/samples/latest/utils.js"></script>
  <script>
    var chartdata = {
    type: 'bar',
    data: {
    labels: <?php echo json_encode($Months); ?>,
    // labels: month,
    datasets: [
    {
    label: 'this year',
    backgroundColor: '#26B99A',
    borderWidth: 1,
    data: <?php echo json_encode($Data); ?>
    }
    ]
    },
    options: {
    scales: {
    yAxes: [{
    ticks: {
    beginAtZero:true
    }
    }]
    }
    }
    }
    var ctx = document.getElementById('canvas').getContext('3d');
    new Chart(ctx, chartdata);
    </script>

