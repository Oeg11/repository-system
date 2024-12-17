@extends('studentgoogleauth.glayouts.main')
@section('content')
<div class="row" style="margin-top:5%">
    <div class="col-md-10">
        <h3>View Thesis</h3>
    </div>
    <div id="loader"></div>
    <div class="col-md-2">
        <div class="d-flex">
            <div class="flex-1"><a href="{{ route('studentgoogleauth.project') }}" type="submit"
                    class="btn btn-info text-light">Back</a></div>
        </div>
    </div>
</div>

<div class="row g-1">
    <div class="col-md-3"></div>
    <div class="col-md-9">

        <div class="container" style="margin-top:5%;margin-bottom:15%">
            <div class="card p-2">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ (!empty($getonethesis->banner_path)) ? url('/storage/uploads/'.$getonethesis->banner_path) :  url('assets/uploads/No_Image_Available.jpg')}}"
                            alt="..." height="250px" width="250px" class="mb-5 bg-white rounded shadow">

                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-8">
                        <div class="mb-3 text-white feature bg-primary bg-gradient rounded-3"><i
                                class="bi bi-building"></i></div>
                        <h1><b>{!! html_entity_decode(ucwords($getonethesis->title)) !!}</b></h1>
                        <label style="font-weight:bolder">Abstract</label><br>
                        <p class="mb-0 w-100"> {!! html_entity_decode($getonethesis->abstract) !!}</p><br>

                        <label style="font-weight:bolder">Authors</label><br>
                        <p class="mb-0 w-100"> {!! html_entity_decode($getonethesis->members) !!}</p><br>

                        <label style="font-weight:bolder">Adviser</label><br>
                        <p class="mb-0 w-100"> {!! html_entity_decode($getonethesis->adviser) !!}</p><br>

                        <label style="font-weight:bolder">Thesis Coordinator</label><br>
                        <p class="mb-0 w-100"> {!! html_entity_decode($getonethesis->thesis_coordinator) !!}</p><br>


                        {{-- <iframe src="{{ (!empty($getonethesis->document_path)) ? url('/storage/uploads/'.$getonethesis->document_path) :  url('assets/uploads/No_Image_Available.jpg')}}" width="100%" height="600px" oncontextmenu="return false;"></iframe> --}}
                        <body oncontextmenu="return false">
                            <iframe id="pdfFrame" width="100%" height="600px" src="{{ (!empty($getonethesis->document_path)) ? url('/storage/uploads/'.$getonethesis->document_path.'#toolbar=0') :  url('assets/uploads/No_Image_Available.jpg')}}"></iframe>
                            <script>
                                // Disable right-click globally
                                document.addEventListener('contextmenu', function (e) {
                                    e.preventDefault();
                                    alert("Right-click is disabled!");
                                });

                                // Disable mouse actions globally (left-click, right-click, middle-click)
                                document.addEventListener('mousedown', function (e) {
                                    e.preventDefault();
                                });

                                document.addEventListener('mouseup', function (e) {
                                    e.preventDefault();
                                });

                                // Disable keyboard shortcuts
                                document.addEventListener('keydown', function (e) {
                                    const forbiddenKeys = ['c', 'v', 'x', 'u', 'p', 's', 'a']; // Add more keys as needed
                                    if (e.ctrlKey && forbiddenKeys.includes(e.key.toLowerCase())) {
                                        e.preventDefault();
                                        alert('Copy, paste, and other shortcuts are disabled!');
                                    }

                                    // Block F12 (Developer Tools)
                                    if (e.key === 'F12') {
                                        e.preventDefault();
                                        alert('Developer tools are disabled!');
                                    }

                                    // Attempt to block PrintScreen (not foolproof)
                                    if (e.key === 'PrintScreen') {
                                        e.preventDefault();
                                        alert('Screenshots are disabled!');
                                    }
                                });

                                // Additional measure: blur content on PrintScreen (experimental)
                                document.addEventListener('keyup', function (e) {
                                    if (e.key === 'PrintScreen') {
                                        alert('Screenshots are disabled!');
                                        document.body.style.filter = 'blur(10px)'; // Blur the screen temporarily
                                        setTimeout(() => {
                                            document.body.style.filter = 'none'; // Restore clarity
                                        }, 1000);
                                    }
                                });
                            </script>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
                            <script>
                                const url = '{{ url('/storage/uploads/'.$getonethesis->document_path) }}';
                                const pdfViewer = document.getElementById('pdfViewer');

                                pdfjsLib.getDocument(url).promise.then(function (pdf) {
                                    pdf.getPage(1).then(function (page) {
                                        const canvas = document.createElement('canvas');
                                        const context = canvas.getContext('2d');
                                        const viewport = page.getViewport({ scale: 1.5 });
                                        canvas.width = viewport.width;
                                        canvas.height = viewport.height;
                                        pdfViewer.appendChild(canvas);
                                        page.render({ canvasContext: context, viewport: viewport });
                                    });
                                });
                            </script>
                        </body>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
PDFViewerApplicationOptions.set('disablePrinting', true);

// Disable download button
PDFViewerApplicationOptions.set('disableDownload', true);
</script> --}}
@endsection
