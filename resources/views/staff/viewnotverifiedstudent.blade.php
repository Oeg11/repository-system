@extends('staff.flayouts.main')
@section('content')

<div class=" mt-4">
  <div id="loader"></div>
    <div class="row p-2 ">

        <div class="col-md-3"></div>
        <div class="col-md-9">


    <div class="card p-2 " style="border-top:2px solid #007bff;margin-top:5%">
        <div class="card-body">
            <h1>View Not Verified Student</h1>
            <hr>

            <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                <div class="card-body ">


                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Department</th>
                            <th scope="col">Curriculum</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($notverifiedstudent as $item)
                          <tr>
                            <th>{{ $item->fullname }}</th>
                            <th>{{ $item->email }}</th>
                            <th>{{ $item->department_name }}</th>
                            <th>{{ $item->curriculum_name }}</th>
                            <th>
                              @if($item->status == 1)
                              <span class="badge bg-success">Approved</span>
                            @elseif($item->status == 0)
                              <span class="badge bg-danger">Rejected</span>
                            @else
                              <span class="badge bg-warning">Pending</span>
                            @endif
                            </th>

                          </tr>

                          @endforeach
                        </tbody>
                      </table>

                </div>
            </div>

        </div>
    </div>

        </div>
    </div>

</div>

@endsection
