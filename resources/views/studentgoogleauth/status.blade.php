@extends('studentgoogleauth.glayouts.main')
@section('content')

<div class=" mt-4">
    <div class="row p-2 ">
        <div id="loader"></div>
        <div class="col-md-3"></div>
        <div class="col-md-9">


    <div class="card p-2 " style="border-top:2px solid #007bff;margin-top:5%">
        <div class="card-body">
            <h1>Submitted Project List</h1>
            <hr>

            <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                <div class="card-body ">


                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th scope="col">Date Created</th>
                            <th scope="col">Archive Code</th>
                            {{-- <th scope="col">Category</th> --}}
                            <th scope="col">Project Title</th>
                            {{-- <th scope="col">Curriculum</th> --}}
                            <th scope="col">Status</th>
                            <th scope="col">Remarks</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($archive as $item)
                          <tr>
                            <th>{{ $item->created_at }}</th>
                            <th>{{ $item->archive_code }}</th>
                            {{-- <th>{{ $item->category }}</th> --}}
                            <th>{{ $item->title }}</th>
                            {{-- <th>{{ $item->curriculum_name }}</th> --}}
                            <th>
                                 @if($item->status == 1)
                                   <span class="badge bg-success">Approved</span>
                                 @elseif($item->status == 0)
                                   <span class="badge bg-danger">Rejected</span>
                                 @else
                                   <span class="badge bg-warning">Pending</span>
                                 @endif
                            </th>
                            <th>{{ $item->remark }}</th>
                            <th>
                                {{-- <button type="button" class="btn btn-primary">Edit</button> --}}
                                <a href="{{ route('googleauthprojects.edit', ['id' => encrypt($item->archives_id)]) }}" class="btn btn-primary btn-sm">Edit</a>
                                 <button type="button" id="btn-deleteproject" data-did="{{$item->archives_id}}" class="btn btn-danger btn-sm">Delete</button></th>
                          </tr>

                          @endforeach
                        </tbody>
                      </table>

                </div>
            </div>


            <div class="d-flex justify-content-center">
                {!! $archive->links() !!}
            </div>
        </div>
    </div>

        </div>
    </div>

</div>

@endsection
