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
                <div class="row">
                    <div class="col-md-6">
                      <!-- AREA CHART -->

                      <!-- DONUT CHART -->
                      <div class="card card-danger">
                        <div class="card-header">
                          <h3 class="card-title">Category Analytic</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body">
                            <canvas id="bargraph2"></canvas>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->

                      <!-- PIE CHART -->

                      <!-- /.card -->

                    </div>
                    <!-- /.col (LEFT) -->
                    <div class="col-md-6">
                      <!-- LINE CHART -->

                      <!-- /.card -->

                      <!-- BAR CHART -->

                      <!-- /.card -->

                      <!-- STACKED BAR CHART -->
                      <div class="card card-danger">
                        <div class="card-header">


                          <h3 class="card-title">Type Analytic</h3>

                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body">

                                    {{-- <div class="row d-flex">
                                            <div class="col-md-3">
                                                <label for="country">Country</label>
                                                <select class="form-control" id="type">
                                                    @foreach ($types as $row)
                                                        <option value="{{ $row->id }}">{{ $row->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        <div class="col-md-3">
                                            <label for="From">From</label>
                                            <input type="date" id="from" name="from" class="form-control" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="To">To</label>
                                            <input type="date" id="to" name="to" class="form-control" />
                                        </div>
                                        <div class="col-md-3">
                                            <label  style="color:white">x</label>
                                            <input type="button" class="btn btn-success mt-3" value="Filter" onclick="getData()" />
                                        </div>
                                    </div>
                               <hr> --}}

                               <div class="chart chart-lg">
                                <canvas id="chartjs-pie2"></canvas>
                            </div>

                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->

                    </div>
                    <!-- /.col (RIGHT) -->
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

  {{-- <script type="text/javascript">

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

  </script> --}}
