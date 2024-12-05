@extends('staff.flayouts.main')
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
              <li class="breadcrumb-item"><a href="{{ route('staff.dashboard')}}">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <section class="content">
      <div class="container-fluid">
        <h2>List of Students</h2><hr>
        <table class="table table-bordered data-table2">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    {{-- <th scope="col">Status</th> --}}
                    <th width="100px">Action</th>

                </tr>
            </thead>
             <tbody>
               {{-- content here --}}
            </tbody>
        </table>
      </div>
    </section>
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

              {data: 'name', name: 'name'},

              {data: 'email', name: 'email'},

              {data: 'role', name: 'role'},

            //   {data: 'status', name: 'status'},

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
         var name
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

            name = $(this).data('fname');
            console.log("=================name===============");
            console.log(name);


            email = $(this).data('email');
            console.log("=================email===============");
            console.log(email);


            status = $(this).data('status');
            console.log("=================status===============");
            console.log(status);



            $('#view_id').val(id);
            $('#view_fullname').val(name);
            $('#view_email').val(email);

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
