@extends('staff.flayouts.main')
@section('content')

<div class="content-wrapper">
  <div id="loader"></div>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('staff.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
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
                <div class="row">
                    <div class="col-md-10">List of Students</h2></div>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-hover data-table2">
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
                    </tbody>
                </table>
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

 @include('staff.modal.viewstudent')


  @endsection
  <script src="{{ asset('assets/js/jquery-3.5.1.js') }}"></script>
  <script src="{{ asset('assets/toastr.min.js') }}"></script>




  <script type="text/javascript">

  $(document).ready(function(){

    //view all archive

      var table = $('.data-table2').DataTable({

          processing: true,

          serverSide: true,

          ajax: "{{ route('staff.studentlist') }}",

          columns: [

              {data: 'student_id', name: 'student_id'},

              {data: 'fullname', name: 'fullname'},

              {data: 'email', name: 'email'},

              {data: 'status', name: 'status'},

              {data: 'action', name: 'action', orderable: false, searchable: false},

          ]

      });

         //end view all archive

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

        ///end get id



          //delete Archive
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
                        url: '{{ route("staff.deletestudent") }}',
                        success: function (res) {
                            if (res.status == 200) {
                                toastr.success('Delete Student Successfully!', 'Success!', {timeOut: 2000})
                                $('.data-table2').DataTable().ajax.reload();
                            }
                        }

                    });

                }
          });

//end delete archive


    });

  </script>
