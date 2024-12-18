@extends('layout.main')
@section('content')


    <!--======================================
           Preloader
    ========================================-->

    <div class="page-preloader">
        <div class="spinner">

            <div class="rect1"></div>

            <div class="rect2"></div>

            <div class="rect3"></div>

            <div class="rect4"></div>

            <div class="rect5"></div>

        </div>
    </div>


    <!--======================================
           Header
    ========================================-->

    <!--//** Navigation**//-->

    <nav class="navbar navbar-default navbar-fixed white no-background bootsnav navbar-scrollspy" data-minus-value-desktop="70" data-minus-value-mobile="55" data-speed="1000">

        <div class="container">

            <!-- Start Header Navigation -->

            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">

                    <i class="fa fa-bars"></i>

                </button>

                <!--<a class="navbar-brand" href="#brand">-->

                <!--    <img src="assets/img/logo.jpg"  class="logo" alt="logo" style="border-radius: 50%">-->

                <!--</a>-->

            </div>

            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="navbar-menu">

                <ul class="nav navbar-nav navbar-right">

                    <li class="active scroll"><a href="#home">Home</a></li>

                    <li class="scroll"><a href="#about">About</a></li>

                    <li class="scroll"><a href="#contact">Contact</a></li>

                    <li class="button-holder">

                     <button type="button" class="btn btn-blue navbar-btn" ><a href="{{ route('view_loginstaff')}}" class="css-href">Login as Staff</a></button>
                    </li>

                </ul>

            </div>

            <!-- /.navbar-collapse -->

        </div>

    </nav>

    <!--//** Banner**//-->

    <section id="home"  class="image">

        <div class="container" >

            <div class="row">

                <!-- Introduction -->

                <div class="col-md-7 caption">

                    <h2 style="font-weight:bold">

                        @foreach ($systeminformation as $sysinfor)
                        {{ $sysinfor->system_name }}
                        @endforeach
                    </h2>

                    <h2>

                            Why choose us?

                            <br>

                            <span class="animated-text"></span>

                            <span class="typed-cursor"></span>

                        </h2>

                    <p>Delve into a world of knowledge with our curated archive of theses, showcasing the depth and breadth of academic research</p>

                    {{-- <a href="#" class="btn btn-transparent">View Projects</a> --}}


                </div>

                <!-- Sign Up -->

                <div class="col-md-5">

                    @if(session()->has('mgs'))
                    <div class="alert alert-success">
                      {{ session()->get('mgs') }}
                    </div>
                  @endif

                  <form class="signup-form"  method="POST">
                    <div id="login-Message"></div>
                    {{-- action="{{ route('user.login') }}" --}}
                    @csrf


                        <h2 class="text-center">Login as Student</h2>

                        <hr>


                        <div class="form-group">

                            <input type="email" class="form-control" id="email" placeholder="Email Address">
                            <span class="text-danger" id="email_mgs"></span>
                        </div>


                        <div class="form-group">

                            <input type="password" class="form-control" id="password" placeholder="Password">
                            <span class="text-danger" id="password_mgs"></span>
                        </div>

                        <hr>

                        <div class="form-group text-center">

                            <button type="button" class="btn btn-blue btn-block btn-login">Login</button>
                            {{-- <a href="{{ url('/login/microsoft') }}" class="btn microsoft-login-btn btn-block mt-2 d-flex">
                              <img src="{{asset('assets/img/4202105_microsoft_logo_social_social media_icon.svg')}}" height="30px" width="30px">&nbsp;&nbsp;Login with Microsoft
                            </a> --}}

                            <a href="{{ route('auth.google') }}" class="btn microsoft-login-btn btn-block mt-2 d-flex">
                                <img src="{{asset('assets/img/2993685_brand_brands_google_logo_logos_icon.svg')}}" height="30px" width="30px">&nbsp;&nbsp;Login with Google
                              </a>

                        </div>


                        {{-- <div class="form-group">
                            Don't Have an account?<a href="{{route('main')}}"> <b style="color:#a31414">Sign up here</b></a>
                         </a>
                         </div> --}}
                    </form>

                </div>

            </div>

        </div>

    </section>


    <!--======================================
           About Us
    ========================================-->

    <section id="about" class="section-padding">

        <div class="container">

            <h2>About Us</h2>

            <p>
                @foreach ($systeminformation as $sysinfor)
                {{ $sysinfor->about }}
                @endforeach
            </p>

            <div class="row">

                <div class="col-md-12">

                    <div class="icon-box">

                        {{-- <i class="material-icons">favorite</i> --}}

                        <h4>How It Works:</h4>

                        <p>
                            @foreach ($systeminformation as $sysinfor)
                            {{ $sysinfor->description}}
                            @endforeach
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!--======================================
           Team
    ========================================-->

    <section id="team" class="section-padding">

        <div class="container">

            <h2>Capstone Members</h2>

            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, optio.</p> --}}

            <div class="row">

                <div class="col-md-6 col-lg-4">

                    <!--**Team-Member**-->

                    <div class="thumbnail team-member">

                        <img src="assets/img/Bea-copy.jpg" class="img-responsive img-circle" alt="team-1">

                        <div class="caption">

                            <h4>Alexander Josh Bea</h4>

                            <h6>Documentation</h6>

                            <p>IT701P</p>

                            <hr>

                            {{-- <div class="team-social">

                                <ul class="liste-unstyled">

                                    <li><a href="#facebook"><i class="fa fa-facebook"></i></a></li>

                                    <li><a href="#twitter"><i class="fa fa-twitter"></i></a></li>

                                    <li><a href="#linkedin"><i class="fa fa-linkedin"></i></a></li>

                                    <li><a href="#instagram"><i class="fa fa-instagram"></i></a></li>

                                </ul>

                            </div> --}}

                        </div>

                    </div>

                </div>

                <div class="col-md-6 col-lg-4">

                    <!--**Team-Member**-->

                    <div class="thumbnail team-member">

                        <img src="assets/img/Geo-copy.jpg" class="img-responsive img-circle" alt="team-2">

                        <div class="caption">

                            <h4>Geo De Leon</h4>

                            <h6>Designer</h6>

                            <p>IT701P</p>

                            <hr>

                            {{-- <div class="team-social">

                                <ul class="liste-unstyled">

                                    <li><a href="#facebook"><i class="fa fa-facebook"></i></a></li>

                                    <li><a href="#twitter"><i class="fa fa-twitter"></i></a></li>

                                    <li><a href="#linkedin"><i class="fa fa-linkedin"></i></a></li>

                                    <li><a href="#instagram"><i class="fa fa-instagram"></i></a></li>

                                </ul>

                            </div> --}}

                        </div>

                    </div>

                </div>

                <div class="col-md-6 col-lg-4">

                    <!--**Team-Member**-->

                    <div class="thumbnail team-member">

                        <img src="assets/img/Lawrence-copy.jpg" class="img-responsive img-circle" alt="team-3">

                        <div class="caption">

                            <h4>Lawrence Dan Albano</h4>

                            <h6>Developer</h6>

                            <p>IT701P</p>

                            <hr>

                            {{-- <div class="team-social">

                                <ul class="liste-unstyled">

                                    <li><a href="#facebook"><i class="fa fa-facebook"></i></a></li>

                                    <li><a href="#twitter"><i class="fa fa-twitter"></i></a></li>

                                    <li><a href="#linkedin"><i class="fa fa-linkedin"></i></a></li>

                                    <li><a href="#instagram"><i class="fa fa-instagram"></i></a></li>

                                </ul>

                            </div> --}}

                        </div>

                    </div>

                </div>



            </div>

        </div>

    </section>


    <!--======================================
           Contact
    ========================================-->

    <section id="contact" class="section-padding" style="margin-bottom :10% ">

        <div class="container">

            <h2>Contact Us</h2>

            <p>We're Here to Help</p>


        </div>

        <!-- Contact Info -->

        <div class="container contact-info">

            <div class="row">

                <div class="col-md-4">

                    <div class="icon-box">

                        <i class="material-icons">place</i>

                        <h4>Address</h4>

                        <p>
                            @foreach ($systeminformation as $sysinfor)
                            {{ $sysinfor->address}}
                            @endforeach
                        </p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="icon-box">

                        <i class="material-icons">phone</i>

                        <h4>Call Us On</h4>

                        <p>
                            @foreach ($systeminformation as $sysinfor)
                            {{ $sysinfor->contact_number}}
                            @endforeach
                        </p>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="icon-box">

                        <i class="material-icons">email</i>

                        <h4>Email us on</h4>

                        <p>
                            @foreach ($systeminformation as $sysinfor)
                            {{ $sysinfor->email}}
                            @endforeach
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>
   @endsection

   <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


   <script>

    $(document).ready(function() {
        $('.btn-login').click(function(e) {
          e.preventDefault();

          // Show loading icon and disable button
          $('#button-text').hide();
          $('#button-loading').show();
          $('.btn-login').attr('disabled', true);

            var email = $('#email').val();
            var password = $('#password').val();

          var timeout = setTimeout(function() {
              $('#button-text').show();
              $('#button-loading').hide();
              $('.btn-login').attr('disabled', false);
          }, 2000);

            $.ajax({
                url: "{{ route('ajax.login') }}",
                type: "POST",
                data: {
                    email: email,
                    password: password,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        $('#button-text').show();
                        $('#button-loading').hide();
                        $('#btn-submit').attr('disabled', false);
                        $('#login-Message').html('<div class="alert alert-success">Login successful!</div>');
                        window.location.href = "{{ route('students.index') }}";
                    } else {
                        $('#login-Message').html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';

                    if (errors.email) {
                        $('#email_mgs').html(errors.email[0]);
                    }

                    if (errors.password) {
                        $('#password_mgs').html(errors.password[0]);
                    }


                    $('#button-text').show();
                    $('#button-loading').hide();
                    $('#btn-submit').attr('disabled', false);
                }
            });
        });
    });

  </script>



   {{-- <script>
    $(document).ready(function(){

        $("#btn-register").on('click', function(e){
            e.preventDefault();

            $.ajaxSetup({
               headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

               }
            });

             $('#fullname-error').html("");
             $('#email-error').html("");
             $('#password-error').html("");
             $('#password_confirmation-error').html("");
             $('#department-error').html("");
             $('#curriculum-error').html("");

           var fullname = $('#fullname').val();
           console.log("========================fullname========================");
           console.log(fullname);

           var email = $('#email').val();
           console.log("========================email========================");
           console.log(email);

           var password = $('#password').val();
           console.log("========================password========================");
           console.log(password);

           var password_confirmation = $('#password_confirmation').val();
           console.log("========================password_confirmation========================");
           console.log(password_confirmation);

           var department = $('#department option:selected').val();
           console.log("========================department========================");
           console.log(department);

           var curriculum = $('#curriculum option:selected').val();
           console.log("========================curriculum========================");
           console.log(curriculum);

           $.ajax({
                    url:"{{ route('student.register') }}",
                    type:"post",
                    data:{
                        fullname: fullname,
                        email: email,
                        password: password,
                        password_confirmation: password_confirmation,
                        department: department,
                        curriculum: curriculum

                    },
                    dataType:"json",
                    success: function(res){

                        if(res.status == 200){
                            toastr.success('Account successfully registered.');
                            setTimeout(function (){
                                window.location.href ="{{ route('view_login') }}";

                              }, 1500);
                            }



                            if(res.errors){

                                if(res.errors.fullname){
                                    $('#fullname-error').html(res.errors.fullname[0]);
                                    $('#fullname').removeClass("is-valid").addClass("is-valid");

                                }else{
                                    $('#fullname').removeClass("is-valid").addClass("is-valid");

                                }

                                if(res.errors.email){
                                    $('#email-error').html(res.errors.email[0]);
                                    $('#email').removeClass("is-valid").addClass("is-valid");

                                }else{
                                    $('#email').removeClass("is-valid").addClass("is-valid");

                                }

                                if(res.errors.password){
                                    $('#password-error').html(res.errors.password[0]);
                                    $('#password').removeClass("is-valid").addClass("is-valid");

                                }else{
                                    $('#password').removeClass("is-valid").addClass("is-valid");

                                }

                                if(res.errors.password_confirmation){
                                    $('#password_confirmation-error').html(res.errors.password_confirmation[0]);
                                    $('#password_confirmation').removeClass("is-valid").addClass("is-valid");

                                }else{
                                    $('#password_confirmation').removeClass("is-valid").addClass("is-valid");

                                }

                                if(res.errors.department){
                                    $('#department-error').html(res.errors.department[0]);
                                    $('#department').removeClass("is-valid").addClass("is-valid");

                                }else{
                                    $('#department').removeClass("is-valid").addClass("is-valid");

                                }

                                if(res.errors.curriculum){
                                    $('#curriculum-error').html(res.errors.curriculum[0]);
                                    $('#curriculum').removeClass("is-valid").addClass("is-valid");

                                }else{
                                    $('#curriculum').removeClass("is-valid").addClass("is-valid");

                                }

                            }

                        }


               });


        });

    });
</script> --}}

