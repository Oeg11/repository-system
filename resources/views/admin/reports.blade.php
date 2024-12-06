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
                 <h2>Analytic Reports</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="chart-output"></div>


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
  {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>

  <script type="text/javascript">

      var charts =  {{ Js::from($charts) }};



      Highcharts.chart('chart-output', {

          title: {

              text: 'New User Growth, 2022'

          },

          subtitle: {

              text: 'Source: Data Analytic'

          },

           xAxis: {

              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

          },

          yAxis: {

              title: {

                  text: 'Number of New Users'

              }

          },

          legend: {

              layout: 'vertical',

              align: 'right',

              verticalAlign: 'middle'

          },

          plotOptions: {

              series: {

                  allowPointSelect: true

              }

          },

          series: [{

              name: 'New Data',

              data: charts

          }],

          responsive: {

              rules: [{

                  condition: {

                      maxWidth: 500

                  },

                  chartOptions: {

                      legend: {

                          layout: 'horizontal',

                          align: 'center',

                          verticalAlign: 'bottom'

                      }

                  }

              }]

          }

  });

  </script>
