@extends('staff.flayouts.main')
@section('content')

<div class=" mt-4">
    <div class="row p-2 ">

        <div class="col-md-3"></div>
        <div class="col-md-9">


    <div class="card p-2 " style="border-top:2px solid #007bff;margin-top:5%">
        <div class="card-body">
            <h1>View Not Verified Archive</h1>
            <hr>

            <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                <div class="card-body ">


                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Archive Code</th>
                            {{-- <th scope="col">Category</th> --}}
                            <th scope="col">Project Title</th>
                            <th scope="col">Department</th>
                            <th scope="col">Curriculum</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($notverifiedarchive as $item)
                          <tr>
                            <th>{{ $item->category }}</th>
                            <th>{{ $item->created_at }}</th>
                            <th>{{ $item->archive_code }}</th>
                            {{-- <th>{{ $item->category }}</th> --}}
                            <th>{{ $item->title }}</th>
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
