@extends('admin.alayouts.main')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
        <div class="table-responsive">
      <div class="container-fluid">
        <h2>List of Students</h2><hr>

          <table class="table table-bordered data-table2">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th width="100px">Action</th>

                </tr>
            </thead>
             <tbody>
               {{-- content here --}}
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </div>

 @include('admin.modal.viewstudent')
 @include('admin.modal.editstudentstatus')


  @endsection
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




  <script type="text/javascript">

  $(document).ready(function(){

    //view all student

      var table = $('.data-table2').DataTable({

          processing: true,

          serverSide: true,

          ajax: "{{ route('admin.studentlist') }}",

          columns: [

              {data: 'student_id', name: 'student_id'},

              {data: 'fullname', name: 'fullname'},

              {data: 'email', name: 'email'},

              {data: 'status', name: 'status'},

              {data: 'action', name: 'action', orderable: false, searchable: false},

          ]

      });

         //end view all student

      ///get id


      $('.modelClose').on('click', function(){
                $('#modal-viewstudent').hide();
            });

         var status
         var email
         var fullname
         var curriculum_name
         var department_name
         var id

        $('body').on('click', '.btn-viewstudent', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            id = $(this).data('id');
            console.log("=================id===============");
            console.log(id);

            fullname = $(this).data('fname');
            console.log("=================fullname===============");
            console.log(fullname);


            email = $(this).data('email');
            console.log("=================email===============");
            console.log(email);

            curriculum_name = $(this).data('cur');
            console.log("=================curriculum_name===============");
            console.log(curriculum_name);

            department_name = $(this).data('dept');
            console.log("=================department_name===============");
            console.log(department_name);


            status = $(this).data('status');
            console.log("=================status===============");
            console.log(status);



            $('#view_id').val(id);
            $('#view_fullname').val(fullname);
            $('#view_email').val(email);
            $('#view_curriculum_name').val(curriculum_name);
            $('#view_department_name').val(department_name);

            if(status == 1){
                $('#view_status').html('<span class="badge badge-pill badge-success">Verified</span>');
            }else{
                $('#view_status').html('<span class="badge badge-pill badge-danger">Not Verified</span>');
            }




        });

        ///end get id2


        $('.modelClose').on('click', function(){
                $('#modal-viewstudent').hide();
            });

         var status
         var id

        $('body').on('click', '.btn-editstudentstatus', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            status = $(this).data('status1');
            console.log("=================status===============");
            console.log(status);

            id = $(this).data('id');
            console.log("=================id===============");
            console.log(id);

            $('#edit_id').val(id);
            $('#edit_student_status').val(status);


        });

        ///end get id2


            //edit edit student
            $('body').on('click', '#btn-updatestudentstatus', function(e){

                    e.preventDefault();
                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                    let status = $('#edit_student_status').val();
                    let id =  $('#edit_id').val();


                    $.ajax({
                        url: '{{ route("admin.updatestudentstatus") }}',
                        method: 'post',
                        data: {
                            status: status,
                            id: id
                        },
                        success: function(response){
                            // console.log(response.status == "Success");
                            if(response.status == 200){

                            $('#mgs_').html('<div class="alert alert-success">Update Status Successfully!</div>');
                                setTimeout(function(){
                                    $('.data-table2').DataTable().ajax.reload();
                                    $("#modal-editstudentstatus").modal('hide');
                                    window.location.reload();
                                }, 2000);
                        }
                        if(response.errors) {
                            console.log("Failed");

                        }

                    },
              });
          });
       //end edit student



          //delete student
          $('body').on('click', '.btn-deleteStudent', function (e) {

                let id = $(this).data('del');
                $('#del_id').val(id);

                let csrf = '{{ csrf_token() }}';
                if (!confirm('Are You sure want to delete this Student!')) {
                    e.preventDefault();
                }else{

                    $.ajax({
                        type: "DELETE",
                        data: {
                                id: id,
                                _token: csrf
                            },
                        cache: false,
                        dataType: 'json',
                        url: '{{ route("admin.deletestudent") }}',
                        success: function (res) {
                            if (res.status == 200) {
                                toastr.success('Delete Student Successfully!', 'Success!', {timeOut: 2000})
                                $('.data-table2').DataTable().ajax.reload();
                            }
                        }

                    });

                }
          });

//end delete student


    });

  </script>
