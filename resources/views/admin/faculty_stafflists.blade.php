@extends('admin.alayouts.main')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Home</a></li>
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
                    <div class="col-md-10">List of Faculty/Staff</h2></div>
                    <div class="col-md-2"><button type="button" class="btn btn-success"
                         data-toggle="modal" data-target="#modal-addstaff">Add Staff</button></div>
                    @include('admin.modal.addstaff')
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-hover data-table5">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            {{-- <th scope="col">Password</th> --}}
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

 @include('admin.modal.editfacultystaff')


  @endsection
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




  <script type="text/javascript">

  $(document).ready(function(){

    //view all faculty staff

      var table = $('.data-table5').DataTable({

          processing: true,

          serverSide: true,

          ajax: "{{ route('admin.faculty_stafflist') }}",

          columns: [

              {data: 'id', name: 'id'},

              {data: 'fullname', name: 'fullname'},

              {data: 'email', name: 'email'},

            //   {data: 'password', name: 'password'},

              {data: 'status', name: 'status'},

              {data: 'action', name: 'action', orderable: false, searchable: false},

          ]

      });

     //end view all faculty staff

    //add  staff

        $('body').on('click', '#btn-addStaff', function(e){

            e.preventDefault();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $('#firstname-error').html("");
            $('#lastname-error').html("");
            $('#email-error').html("");
            $('#password-error').html("");

            let firstname = $('#firstname').val();
            let middlename = $('#middlename').val();
            let lastname = $('#lastname').val();
            let email = $('#email').val();
            let password = $('#password').val();

            $.ajax({
                url: '{{ route("admin.addstaff") }}',
                method: 'post',
                data: {
                    firstname: firstname,
                    middlename: middlename,
                    lastname: lastname,
                    email: email,
                    password: password

                },
                success: function(data){

                    console.log(data);
                        if(data.errors) {

                            if(data.errors.firstname){
                                $('#firstname-error').html(data.errors.firstname[0]);
                            }

                            if(data.errors.lastname){
                                $('#lastname-error').html(data.errors.lastname[0]);
                            }


                            if(data.errors.email){
                                $('#email-error').html(data.errors.email[0]);
                            }

                            if(data.errors.password){
                                $('#password-error').html(data.errors.password[0]);
                            }

                        }
                    // console.log(response.status == "Success");
                    if(data.status == 200){

                    $('#mgs').html('<div class="alert alert-success">Add Staff Successfully!</div>');
                        setTimeout(function(){
                            $('.data-table5').DataTable().ajax.reload();
                            $("#modal-addstaff").modal('hide');
                            window.location.reload();
                        }, 2000);
                }
                if(data.errors) {
                    console.log("Failed");

                }

            },
         });
       });
     //end add  staff

      ///get id


      $('.modelClose').on('click', function(){
                $('#modal-viewstudent').hide();
            });

         var firstname
         var middlename
         var lastname
         var email
         var status
         var id

        $('body').on('click', '.btn-fstaff', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            firstname = $(this).data('fname');
            console.log("=================firstname===============");
            console.log(firstname);


            middlename = $(this).data('mname');
            console.log("=================middlename===============");
            console.log(middlename);

            lastname = $(this).data('lname');
            console.log("=================lastname===============");
            console.log(lastname);

            email = $(this).data('email');
            console.log("=================email===============");
            console.log(email);


            status = $(this).data('stat');
            console.log("=================status===============");
            console.log(status);


            id = $(this).data('id');
            console.log("=================id===============");
            console.log(id);

            $('#edit_firstname').val(firstname);
            $('#edit_middlename').val(middlename);
            $('#edit_lastname').val(lastname);
            $('#edit_email').val(email);
            $('#edit_status').val(status);
            $('#edit_id').val(id);


        });

        ///end get id


          //edit edit faculty staff
             $('body').on('click', '#btn-editfstaff', function(e){

                    e.preventDefault();
                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                    let firstname = $('#edit_firstname').val();
                    let middlename = $('#edit_middlename').val();
                    let lastname = $('#edit_lastname').val();
                    let email = $('#edit_email').val();
                    let status = $('#edit_status').val();
                    let id =  $('#edit_id').val();


                    $.ajax({
                        url: '{{ route("admin.updatefacultystaff") }}',
                        method: 'post',
                        data: {
                            firstname:firstname,
                            middlename: middlename,
                            lastname: lastname,
                            email: email,
                            status: status,
                            id: id
                        },
                        success: function(response){
                            // console.log(response.status == "Success");
                            if(response.status == 200){

                            $('#mgs2').html('<div class="alert alert-success">Update Faculty/Staff Successfully!</div>');
                                setTimeout(function(){
                                    $('.data-tabl5').DataTable().ajax.reload();
                                    $("#modal-editfacultystaff").modal('hide');
                                    window.location.reload();
                                }, 2000);
                        }
                        if(response.errors) {
                            console.log("Failed");

                        }

                    },
               });
          });
        //end edit faculty staff



          //delete faculty staff
          $('body').on('click', '.btn-deletefacultystaff', function (e) {

                let id = $(this).data('del');
                $('#del_id').val(id);

                let csrf = '{{ csrf_token() }}';
                if (!confirm('Are You sure want to delete this Faculty/Staff!')) {
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
                        url: '{{ route("admin.deletefacultystaff") }}',
                        success: function (res) {
                            if (res.status == 200) {
                                toastr.success('Delete Faculty/Staff Successfully!', 'Success!', {timeOut: 2000})
                                $('.data-table5').DataTable().ajax.reload();
                            }
                        }

                    });

                }
          });

//end delete faculty staff


    });

  </script>
