@extends('admin.alayouts.main')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div id="loader"></div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <section class="content">
        <div class="container-fluid">




            <div class="card mt-4">
                <div class="card-body">
                    <form method="POST">
                        <div class="col-md-10"><h2>User Control</h2></div>
                        <button type="button"  data-toggle="modal" data-target="#modal-addstaffcontrol" class="btn btn-success w-100 mt-2 my-button">Add User Control</button>
                        <hr>
                        {{-- <select class="form-control" aria-label="Default select example">
                            <option selected="true" disabled="disabled"> &larr; Select Staff &rarr;</option>
                            @foreach ($staffs as $row)
                            <option value="{{  $row->id }}">{{ $row->firstname .' '. $row->lastname }}</option>
                            @endforeach
                        </select> --}}

                        <div class="card">

                            <div class="card-body">
                               <div class="row">
                                  {{-- <div class="col-md-10"> <h4 ><b>Collection List Control</b></h4></div> --}}
                                  <div class="col-md-2">
                                     <button type="button"  data-toggle="modal" data-target="#modal-addstaffcontrol" class="btn btn-primary w-100 mt-2 my-button">Add User Control</button>
                                     @include('admin.modal.addstaffcontrol')
                                  </div>
                               </div>

                                <hr>
                                <div id="mgs"></div>


                                <ul class="list-group">


                                    <form method="POST">

                                        <div class="row">



                                            @foreach ($collections as $row)

                                            <div class="col-md-3 mt-3">

                                                <li class="list-group-item" style="background-color:aquamarine">
                                                    <p class="mt-2">Name: <b>{{ $row->firstname.' '. $row->lastname }}</b>
                                                       <i class="fa fa-edit text-blue btn-editusercontrols" data-toggle="modal" data-target="#modal-editstaffcontrol"
                                                        data-staff_id_="{{ $row->staff_id }}"
                                                        data-views_="{{ $row->collectionlist_view }}"
                                                        data-ustatus_="{{ $row->collectionlist_updatestatus }}"
                                                        data-delete_="{{ $row->collectionlist_delete }}"
                                                        data-id_="{{ $row->usercontrol_id }}"
                                                        style="float:right"></i>
                                                       @include('admin.modal.editstaffcontrol')
                                                </li>
                                                <li class="list-group-item">
                                                    &nbsp;&nbsp;<input class="form-check-input me-1" type="checkbox"
                                                        id="collectionlist_view" {{ $row->collectionlist_view ?
                                                    'checked' : '' }} aria-label="...">
                                                    View
                                                </li>
                                                <li class="list-group-item">
                                                    &nbsp;&nbsp;<input class="form-check-input me-1" type="checkbox"
                                                        id="collectionlist_updatestatus" {{
                                                        $row->collectionlist_updatestatus ? 'checked' : '' }}
                                                    aria-label="...">
                                                    Update Status
                                                </li>
                                                <li class="list-group-item">
                                                    &nbsp;&nbsp;<input class="form-check-input me-1" type="checkbox"
                                                        id="collectionlist_delete" {{ $row->collectionlist_delete ?
                                                    'checked' : '' }} aria-label="...">
                                                    Delete
                                                </li>

                                            </div>
                                            @endforeach

                                        </div>

                                    </form>

                                </ul>



                            </div>
                        </div>

                    </form>
                </div>

            </div>
    </section>

</div>
@endsection




<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script type="text/javascript">
    $(document).ready(function () {

        $('.btn-editusercontrols').on('click', function () {

            var edit_staff_id = $(this).data('staff_id_');
            console.log(edit_staff_id);

            var edit_views = $(this).data('views_');
            if(edit_views === 1){
                $('#edit_views').prop('checked', true)//show check if value is 1
              }else{
                $('#edit_views').prop('checked', false)//show check if value is 0

            }

            var edit_ustatus = $(this).data('ustatus_');
            if(edit_ustatus === 1){
                $('#edit_ustatus').prop('checked', true)//show check if value is 1
              }else{
                $('#edit_ustatus').prop('checked', false)//show check if value is 0

            }

            var edit_delete = $(this).data('delete_');
            if(edit_delete === 1){
                $('#edit_delete').prop('checked', true)//show check if value is 1
              }else{
                $('#edit_delete').prop('checked', false)//show check if value is 0

            }

            var id = $(this).data('id_');
            console.log(id);

            $('#edit_staff_id').val(edit_staff_id);
            $('#id').val(id);

        });


        $(document).on('click', '#btn-editusercontrol', function () {

               var staff_id = $('#edit_staff_id').val();
                console.log(staff_id);

                var collectionlist_view = $('#edit_views').is(':checked') ? 1 : 0;
                console.log(collectionlist_view);

                 var collectionlist_updatestatus = $('#edit_ustatus').is(':checked') ? 1 : 0;
                 console.log(collectionlist_updatestatus);

                 var collectionlist_delete = $('#edit_delete').is(':checked') ? 1 : 0;
                 console.log(collectionlist_delete);

                 var id = $('#id').val();
                 console.log(id);

                $.ajax({
                    url: '{{ route("admin.updateusercontrol") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        staff_id: staff_id,
                        collectionlist_view: collectionlist_view,
                        collectionlist_updatestatus: collectionlist_updatestatus,
                        collectionlist_delete: collectionlist_delete,
                        id: id

                    },
                        success: function(response){
                            if(response.status == 200){

                            $('#mgs__').html('<div class="alert alert-success">Update User Control Successfully!</div>');
                                setTimeout(function(){
                                    window.location.reload();
                                }, 2000);
                        }
                        if(response.errors) {
                            console.log("Failed");

                        }

                    },
                });

            });


            // add user control below
            $(document).on('click', '#btn-addusercontrol', function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#staff_id-error').html("");

                staff_id = $("#staff_id").val();
                console.log("=================staff_id===============");
                console.log(staff_id);

               var collectionlist_view = $('#collectionlist_view').is(':checked') ? 1 : 0;
               console.log(collectionlist_view);

               var collectionlist_updatestatus = $('#collectionlist_updatestatus').is(':checked') ? 1 : 0;
                console.log(collectionlist_updatestatus);

                var collectionlist_delete = $('#collectionlist_delete').is(':checked') ? 1 : 0;
                console.log(collectionlist_delete);

                $.ajax({
                    url: '{{ route("admin.addusercontrol") }}',
                    type: 'POST',
                    data: {
                        staff_id: staff_id,
                        collectionlist_view: collectionlist_view,
                        collectionlist_updatestatus: collectionlist_updatestatus,
                        collectionlist_delete: collectionlist_delete,


                    },

                        success: function(response){


                        console.log(response);
                            if(response.errors) {
                                if(response.errors.staff_id){
                                    $('#staff_id-error').html(response.errors.staff_id[0]);
                                }


                            }

                            if(response.status == 200){

                            $('#mgs_').html('<div class="alert alert-success">Add User Control Successfully!</div>');
                                setTimeout(function(){
                                    window.location.reload();
                                }, 2000);
                        }
                        if(response.errors) {
                            console.log("Failed");

                        }

                    },
                });

            });

             //end add user control below


        });

</script>
