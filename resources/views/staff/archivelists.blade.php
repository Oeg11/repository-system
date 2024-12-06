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
                    <div class="col-md-10">List of Collection</h2></div>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-bordered table-hover data-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Category</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Archive Code</th>
                            {{-- <th scope="col">Category</th> --}}
                            <th scope="col">Project Title</th>
                            <th scope="col">Department</th>
                            <th scope="col">Curriculum</th>
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

  @include('staff.modal.viewarchive')
 @include('staff.modal.archiveupdatestatus')


  @endsection
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




  <script type="text/javascript">

  $(document).ready(function(){

    //view all archive

      var table = $('.data-table').DataTable({

          processing: true,

          serverSide: true,

          ajax: "{{ route('staff.archive') }}",

          columns: [

              {data: 'archive_id', name: 'archive_id'},

              {data: 'category', name: 'category'},

              {data: 'created_at', name: 'created_at'},

              {data: 'archive_code', name: 'archive_code'},

              {data: 'title', name: 'title'},

              {data: 'department_name', name: 'department_name'},

              {data: 'curriculum_name', name: 'curriculum_name'},

              {data: 'status', name: 'status'},

              {data: 'action', name: 'action', orderable: false, searchable: false},

          ]

      });

         //end view all archive

                ///get id1


      $('.modelClose').on('click', function(){
                $('#modal-viewarchive').hide();
            });


         var title
         var category
         var department
         var curriculum
         var year
         var abstract
         var members
         var adviser
         var banner_path
         var document_path
         var id

        $('body').on('click', '.btn-viewarchive', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // ClassicEditor.create(document.querySelector("#editor1")).then(editor1 => instance1 = editor1);
            // ClassicEditor.create(document.querySelector("#editor2")).then(editor2 => instance2 = editor2);

            title = $(this).data('title');
            console.log("=================title===============");
            console.log(title);

            category = $(this).data('category');
            console.log("=================category===============");
            console.log(category);


            department = $(this).data('department_');
            console.log("=================department===============");
            console.log(department);

            curriculum = $(this).data('curriculum_');
            console.log("=================curriculum===============");
            console.log(curriculum);

            year = $(this).data('year');
            console.log("=================year===============");
            console.log(year);


            abstract = $(this).data('abstract');
            console.log("=================abstract===============");
            console.log(abstract);

            members = $(this).data('members');
            console.log("=================members===============");
            console.log(members);

            adviser = $(this).data('adviser');
            console.log("=================adviser===============");
            console.log(adviser);


            banner_path = $(this).data('bannerpath');
            console.log("=================banner_path===============");
            console.log(banner_path);

            document_path = $(this).data('documentpath');
            console.log("=================document_path===============");
            console.log(document_path);


            id = $(this).data('id');
            console.log("=================id===============");
            console.log(id);


            $('#view_title').val(title);
            $('#view_category').val(category);
            $('#view_department2').val(department);
            $('#view_curriculum2').val(curriculum);
            $('#view_year').val(year);
             $('._abstract').val(abstract);
            $('._members').val(members);
            $('#view_adviser').val(adviser);
              if(banner_path == ""){
                         $('#view_abanner_path').attr("src", "assets/img/no-image-available.png");
                      }else{
                          $('#view_abanner_path').attr("src", '/storage/uploads/'+ banner_path);
                 }
                 if(document_path == ""){
                         $('#view_document_path').text("No document found");
                      }else{
                          $('#view_document_path').html('<iframe src="/storage/uploads/'+document_path+'" width="750" height="1000">'+document_path+'</iframe>');
                 }
            $('#view_id').val(id);


        });

        ///end get id1


      ///get id


      $('.modelClose').on('click', function(){
                $('#modal-archive').hide();
            });

         var status
         var id

        $('body').on('click', '.btn-update', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            id = $(this).data('id');
            console.log("=================id===============");
            console.log(id);

            status = $(this).data('stat');
            console.log("=================status===============");
            console.log(status);

            $('#edit_id').val(id);
            $('#edit_status').val(status);


        });

        ///end get id


      //edit edit status
             $('body').on('click', '#btn-updatestatus', function(e){

                    e.preventDefault();
                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                    let status = $('#edit_status').val();
                    let id =  $('#edit_id').val();


                    $.ajax({
                        url: '{{ route("staff.updatestatus") }}',
                        method: 'post',
                        data: {
                            status: status,
                            id: id
                        },
                        success: function(response){
                            // console.log(response.status == "Success");
                            if(response.status == 200){
                                $('#mgs').html('<div class="alert alert-success">Update Status Successfully!</div>');
                                $('.data-table').DataTable().ajax.reload();
                                $("#modal-archive").modal('hide');
                        }
                        if(response.errors) {
                            console.log("Failed");

                        }

                      },
                 });
             });
           //end edit status



          //delete Archive
          $('body').on('click', '.btn-deleteArchive', function (e) {

                let id = $(this).data('del');
                $('#del_id').val(id);

                let csrf = '{{ csrf_token() }}';
                if (!confirm('Are You sure want to delete this Archive!')) {
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
                        url: '{{ route("staff.deletearchive") }}',
                        success: function (res) {
                            if (res.status == 200) {
                                toastr.success('Delete Archive Successfully!', 'Success!', {timeOut: 2000})
                                $('.data-table').DataTable().ajax.reload();
                            }
                        }

                    });

                }
          });

//end delete archive


    });

  </script>
