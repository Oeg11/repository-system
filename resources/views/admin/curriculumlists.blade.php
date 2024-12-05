@extends('admin.alayouts.main')
@section('content')

<div class="content-wrapper">
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
                 <div class="row">
                    <div class="col-md-10"><h2>List of Curriculum</h2></div>
                    <div class="col-md-2"><button type="button" class="btn btn-success"
                         data-toggle="modal" data-target="#modal-addcurriculum">Add Curriculum</button></div>
                    @include('admin.modal.addcurriculum')
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-hover data-table4">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Departmant</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
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

 @include('admin.modal.editcurriculum')


  @endsection
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




  <script type="text/javascript">

  $(document).ready(function(){

    //view all curriculum

      var table = $('.data-table4').DataTable({

          processing: true,

          serverSide: true,

          ajax: "{{ route('admin.curriculumlist') }}",

          columns: [

              {data: 'curriculum_id', name: 'curriculum_id'},

              {data: 'department_name', name: 'department_name'},

              {data: 'name', name: 'name'},

              {data: 'description', name: 'description'},

              {data: 'action', name: 'action', orderable: false, searchable: false},

          ]

      });

         //end view all curriculum


    //add  curriculum



        $('body').on('click', '#btn-addcurriculum', function(e){

                e.preventDefault();
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                $('#department_id-error').html("");
                $('#name-error').html("");
                $('#description-error').html("");

                let department_id = $('#department_id').val();
                let name = $('#name').val();
                let description = $('#description').val();

                $.ajax({
                    url: '{{ route("admin.addcurriculum") }}',
                    method: 'post',
                    data: {
                        department_id: department_id,
                        name: name,
                        description: description,

                    },
                    success: function(data){

                        console.log(data);
                            if(data.errors) {
                                if(data.errors.department_id){
                                    $('#department_id-error').html(data.errors.department_id[0]);
                                }
                                if(data.errors.name){
                                    $('#name-error').html(data.errors.name[0]);
                                }
                                if(data.errors.description){
                                    $('#description-error').html(data.errors.description[0]);
                                }

                            }
                        // console.log(response.status == "Success");
                        if(data.status == 200){

                        $('#mgs').html('<div class="alert alert-success">Add Curriculum Successfully!</div>');
                            setTimeout(function(){
                                $('.data-tabl4').DataTable().ajax.reload();
                                $("#modal-addcurriculum").modal('hide');
                                window.location.reload();
                            }, 2000);
                    }
                    if(data.errors) {
                        console.log("Failed");

                    }

                },
              });
         });
      //end add  curriculum


      ///get id


      $('.modelClose').on('click', function(){
                $('#modal-editcurriculum').hide();
            });

         var department_id
         var name
         var description
         var id

        $('body').on('click', '.btn-editcurriculum', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            department_id = $(this).data('deptid');
            console.log("=================department_id===============");
            console.log(department_id);

            name = $(this).data('name');
            console.log("=================name===============");
            console.log(name);

            description = $(this).data('desc');
            console.log("=================description===============");
            console.log(description);


            id = $(this).data('id');
            console.log("=================id===============");
            console.log(id);


            $('#edit_department_id').val(department_id);
            $('#edit_name_2').val(name);
            $('#edit_description_2').val(description);
            $('#edit_id_2').val(id);


        });

        ///end get id


          //edit edit curriculum
          $('body').on('click', '#btn-editcurriculum', function(e){

                e.preventDefault();
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                let department_id = $('#edit_department_id').val();
                let name = $('#edit_name_2').val();
                let description = $('#edit_description_2').val();
                let id =  $('#edit_id_2').val();


                $.ajax({
                    url: '{{ route("admin.updatecurriculum") }}',
                    method: 'post',
                    data: {
                        department_id:department_id,
                        name: name,
                        description: description,
                        id: id
                    },
                    success: function(response){
                        // console.log(response.status == "Success");
                        if(response.status == 200){

                           $('#mgs2').html('<div class="alert alert-success">Update Curriculum Successfully!</div>');
                             setTimeout(function(){
                                $('.data-tabl4').DataTable().ajax.reload();
                                $("#modal-editcurriculum").modal('hide');
                                window.location.reload();
                            }, 2000);
                    }
                    if(response.errors) {
                        console.log("Failed");

                    }

                },
             });
          });
         //end edit curriculum

          //delete curriculum
          $('body').on('click', '.btn-deleteCurriculum', function (e) {

                let id = $(this).data('del');
                $('#del_id').val(id);

                let csrf = '{{ csrf_token() }}';
                if (!confirm('Are You sure want to delete this Curriculum!')) {
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
                        url: '{{ route("admin.deletecurriculum") }}',
                        success: function (res) {
                            if (res.status == 200) {
                                toastr.success('Delete Curriculum Successfully!', 'Success!', {timeOut: 2000})
                                $('.data-table4').DataTable().ajax.reload();
                            }
                        }

                    });

                }
          });

     //end delete curriculum


    });

  </script>
