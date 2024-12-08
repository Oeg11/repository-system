@extends('admin.alayouts.main')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Import user by uploading excel file</h4>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/import')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group">
                            <input type="file" name="import_file" class="form-control">
                            <button class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

  @endsection
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


  {{-- <script type="text/javascript">

  $(document).ready(function(){

    //view all archive

      var table = $('.data-table34').DataTable({
      });

         //end view all archive





    });

  </script> --}}
