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
      <div class="container-fluid">
        <h2>List of Settings</h2><hr>
        <table class="table table-bordered data-table6">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">System Name</th>
                    <th scope="col">System Short Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">About</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact #</th>
                    <th scope="col">Address</th>
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

 @include('admin.modal.editsettings')


  @endsection
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




  <script type="text/javascript">

  $(document).ready(function(){

    //view all settings

      var table = $('.data-table6').DataTable({

          processing: true,

          serverSide: true,

          ajax: "{{ route('admin.settings') }}",

          columns: [

              {data: 'id', name: 'id'},

              {data: 'system_name', name: 'system_name'},

              {data: 'system_short_name', name: 'system_short_name'},

              {data: 'description', name: 'description'},

              {data: 'about', name: 'about'},

              {data: 'email', name: 'email'},

              {data: 'contact_number', name: 'contact_number'},

              {data: 'address', name: 'address'},

              {data: 'action', name: 'action', orderable: false, searchable: false},

          ]

      });

         //end view all settings

      ///get id


      $('.modelClose').on('click', function(){
                $('#modal-editsettings').hide();
            });

         var system_name
         var system_short_name
         var description
         var about
         var email
         var contact_number
         var address
         var id

        $('body').on('click', '.btn-settings', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            system_name = $(this).data('sname');
            console.log("=================system_name===============");
            console.log(system_name);


            system_short_name = $(this).data('ssname');
            console.log("=================system_short_name===============");
            console.log(system_short_name);

            description = $(this).data('desc');
            console.log("=================description===============");
            console.log(description);

            about = $(this).data('about');
            console.log("=================about===============");
            console.log(about);


            email = $(this).data('email');
            console.log("=================email===============");
            console.log(email);

            contact_number = $(this).data('cno');
            console.log("=================contact_number===============");
            console.log(contact_number);

            address = $(this).data('address');
            console.log("=================address===============");
            console.log(address);

            id = $(this).data('id');
            console.log("=================id===============");
            console.log(id);

            $('#edit_system_name').val(system_name);
            $('#edit_system_short_name').val(system_short_name);
            $('#edit_description').val(description);
            $('#edit_about').val(about);
            $('#edit_email').val(email);
            $('#edit_contact_number').val(contact_number);
            $('#edit_address').val(address);
            $('#edit_id').val(id);


        });

        ///end get id


          //edit edit settings
             $('body').on('click', '#btn-editsettings', function(e){

                    e.preventDefault();
                    $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                    let system_name = $('#edit_system_name').val();
                    let system_short_name = $('#edit_system_short_name').val();
                    let description = $('#edit_description').val();
                    let about = $('#edit_about').val();
                    let email = $('#edit_email').val();
                    let contact_number = $('#edit_contact_number').val();
                    let address = $('#edit_address').val();
                    let id =  $('#edit_id').val();


                    $.ajax({
                        url: '{{ route("admin.updatesettings") }}',
                        method: 'post',
                        data: {
                            system_name:system_name,
                            system_short_name: system_short_name,
                            description: description,
                            about: about,
                            email: email,
                            contact_number: contact_number,
                            address: address,
                            id: id
                        },
                        success: function(response){
                            // console.log(response.status == "Success");
                            if(response.status == 200){

                            $('#mgs2').html('<div class="alert alert-success">Update Settings Successfully!</div>');
                                setTimeout(function(){
                                    $('.data-table6').DataTable().ajax.reload();
                                    $("#modal-editsettings").modal('hide');
                                    window.location.reload();
                                }, 2000);
                        }
                        if(response.errors) {
                            console.log("Failed");

                        }

                    },
               });
          });
        //end edit settings



          //delete settings
          $('body').on('click', '.btn-deletesettings', function (e) {

                let id = $(this).data('del');
                $('#del_id').val(id);

                let csrf = '{{ csrf_token() }}';
                if (!confirm('Are You sure want to delete this Settings!')) {
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
                        url: '{{ route("admin.deletesettings") }}',
                        success: function (res) {
                            if (res.status == 200) {
                                toastr.success('Delete Settings Successfully!', 'Success!', {timeOut: 2000})
                                $('.data-table6').DataTable().ajax.reload();
                            }
                        }

                    });

                }
          });

//end delete settings


    });

  </script>
