<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

    <footer>

        <div class="container">

            <div class="row">

                <div class="footer-caption">

                    <!--<img src="{{ asset('assets/img/logo.jpg') }}" class="img-responsive center-block" alt="logo" style="border-radius: 50%">-->

                    <hr>

                    <h5 class="pull-left">STI Marikina &copy;2024 All rights reserved</h5>

                    <ul class="liste-unstyled pull-right">

                        <li><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModal">Terms and Condition</a></li>

                        {{-- <li><a href="#twitter"><i class="fa fa-twitter"></i></a></li>

                        <li><a href="#linkedin"><i class="fa fa-linkedin"></i></a></li>

                        <li><a href="#instagram"><i class="fa fa-instagram"></i></a></li> --}}

                    </ul>

                </div>

            </div>

        </div>

    </footer>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="{{  asset('assets/bootstrap-3.3.7/bootstrap-3.3.7-dist/js/bootstrap.min.js')}}"></script>

    <script src="{{  asset('assets/js/plugins/owl-carousel/owl.carousel.min.js')}}"></script>

    <script src="{{ asset('assets/js/plugins/bootsnav_files/js/bootsnav.js')}}"></script>

    <script src="{{  asset('assets/js/plugins/typed.js-master/typed.js-master/dist/typed.min.js')}}"></script>

    <script src="https://maps.googleapis.com/maps/api/js"></script>

    <script src="{{  asset('assets/js/plugins/Magnific-Popup-master/Magnific-Popup-master/dist/jquery.magnific-popup.js')}}"></script>

    <script src="{{  asset('assets/js/main.js')}}"></script>

</body>

</html>
