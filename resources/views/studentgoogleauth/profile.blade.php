@extends('studentgoogleauth.glayouts.main')
@section('content')
    <div class=" mt-4">

        <div class="row">

            <div class="col-md-3"></div>
            <div class="col-md-7">

        <div class="card shadow-lg p-3 mb-5 bg-body rounded" style="border-top:2px solid #007bff;margin-top:5%">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>

                @foreach ($userauth as $user)
                    <div class="col-md-9">
                        <form method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label><b>Student Name</b></label>
                                    <input type="text" id="fullname" name="fullname" value="{{ $user->name }}" class="form-control form-control-lg">
                                </div>
                                <span id="fullname-error" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-7">
                            <div class="form-group">
                                <label><b>Email</b></label>
                                    <input type="text" id="email" name="email" value="{{ $user->email }}" class="form-control form-control-lg">
                                </div>
                                <span id="email-error" class="text-danger"></span>
                            </div>
                       </div>




                        <div class="row mt-3">
                            <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" id="id" name="id" value="{{ Auth::user()->id }}">
                                <button type="button" class="btn btn-outline-primary" id="btn-update-profile">Update Pofile</button>
                                </div>
                            </div>
                        </div>


                    </form>
                    </div>

                    @endforeach


                </div>
            </div>
          </div>

        </div>
    </div>

    </div>

    @endsection

