@extends('students.slayouts.main')
@section('content')

<div class="container-fluid" style="margin-top:5%">

    <div id="loader"></div>
    <div class="row g-1">

        <div class="col-md-3"></div>
        <div class="col-md-6">

            <div class="card shadow-lg p-3 mb-5 bg-body rounded" style="border-top:2px solid #007bff">
                <div class="card-body">
                    <h1>List of Collection</h1>
                    <hr>

                    <form action="{{ route('students.search')}}" method="get">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" class="mb-3 form-control" placeholder="Search title..." name="q"
                                    autocomplete="off">
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <div class="flex-1"><input type="submit" class="mb-3 btn btn-outline-success"
                                            value="Search"></div>&nbsp;<div class="flex-1"><a
                                            href="{{ route('students.search')}}" type="submit" id="reset"
                                            class="btn btn-warning text-light">Reset</a></div>
                                </div>

                            </div>

                        </div>
                    </form>
                    {{-- @foreach ($archive as $item) --}}

                    @forelse($paginates as $item)
                    <div class="card p-3 mb-5 bg-body rounded">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $item->banner_path ? asset('storage/uploads/'.$item->banner_path) : asset('assets/img/no-image-available.png') }}"
                                    height="200px" width="200px">
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-7">
                                <h2>{{ Str::ucfirst($item->title) }}</h2>

                                <p>
                                    <span style="color:#8c8c8c">By</span> <span style="color:#007bff">{{
                                        Str::ucfirst($item->fullname) }}</span> <span style="color:#007bff">{{
                                            Str::ucfirst($item->name) }}</span>
                                    <br>
                                    <p class="mb-0 w-100"style="color:#8c8c8c;font-size:11px">
                                       {{
                                        Str::ucfirst($item->category) }}</p><Br>


                                    </p><br>

                                <p class="mb-0 w-100"> {!!
                                    html_entity_decode(ucwords(\Illuminate\Support\Str::words($item->abstract , 30)))
                                    !!}</p><Br>


                                </p>

                                <buttton class="btn btn-primary" id="btn-rank" data-id="{{ $item->id }}"
                                    data-slug="{{ $item->slug }}">View More</buttton>

                                {{-- <a id="btn-rank" data-id="{{ $item->id }}" data-slug="{{ $item->slug }}"
                                    href="{{ route('student.viewmore', [$item->slug] ) }}"
                                    class="mt-4 btn btn-outline-primary">View More...</a> --}}


                            </div>

                        </div>
                    </div>

                    @empty
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <svg class="flex-shrink-0 bi me-2" width="24" height="24" role="img" aria-label="Danger:">
                            <use xlink:href="#exclamation-triangle-fill" />
                        </svg>
                        <div>
                            <h3 class="center"><i class="fa fa-times-circle"></i> No Result found, <span
                                    style="font-style:italic;color:#d82929">{{ $getSearchurl }}</span></h3>
                        </div>
                    </div>
                    @endforelse


                    <nav aria-label="...">
                        <ul class="pagination justify-content-center">
                            {!! $paginates->withQueryString()->links() !!}
                        </ul>
                    </nav>


                </div>
            </div>

        </div>


        <div class="col-md-3">
            <div class="card shadow-lg p-3 mb-5 bg-body rounded" style="border-top:2px solid #007bff"
                style="width: 18rem;">
                <div class="card-header">
                    <strong>Most Viewed Projects</strong>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">

                        @php

                        $ranks = DB::table('archives')
                            ->select(
                                'archives.id',
                                'archives.title',
                                'archives.abstract',
                                'archives.count_rank',
                                'archives.banner_path')
                            ->where('archives.status',  1)
                            ->orderBy('archives.count_rank','DESC')
                            ->get();

                        @endphp

                        @foreach ($ranks as $row)
                        <li class="list-group-item">{{ Str::ucfirst($row->title) }} <span class="badge bg-primary"
                                style="float: right">{{ $row->count_rank }}</span></li>
                        @endforeach
                    </ul>

                </div>
            </div>


        </div>


    </div>

</div>

@endsection
