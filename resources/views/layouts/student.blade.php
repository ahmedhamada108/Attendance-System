<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-Exam">
    <meta name="keywords" content="E-Exam">
    <meta name="author" content="E-Exam">
    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_web/css/bootstrap.css') }}">

    <!-- Style css -->
    <link rel="stylesheet" href="{{ asset('assets_web/css/landing_page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_web/css/style.css') }}">

    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets_web/css/animate.css') }}">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_web/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_web/css/themify-icons.css') }}">
    <link rel="icon" href="{{ asset('assets_web/logo.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('assets_web/logo.png') }}" type="image/x-icon" />

    <title>Smart Exam</title>

</head>
<body data-spy="scroll" data-target="#scroll-spy">
    <!-- ---------------------------------- -->
    <!--header start-->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col p-0">
                    <div class="top-header">
                        <div class="logo pl-2">
                            <a class="navbar-brand" href="/">
                                <img style="width: 50px;" src="{{ asset('assets_web/logo.png') }}"alt="logo">
                            </a>
                        </div>
                        <div class="main-menu mx-auto" id="nav">
                            <nav id="navbar-example2" class="navbar navbar-expand-lg navbar-light">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#scroll-spy" aria-controls="scroll-spy" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="scroll-spy">
                                    <ul class="navbar-nav mx-auto nav">
                                        @if(auth('student')->id())
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->segment(2) == '' ? 'student' : ''  }}" href="{{ route('student.dashboard.view') }}">@lang('student.header.home')</a>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a class="nav-link {{ request()->segment(2) == '' ? 'active' : ''  }}" href="/">@lang('student.header.home')</a>
                                            </li>
                                        @endif

                                        <li class="nav-item">
                                            <a class="nav-link {{ request()->segment(2) == 'subjects' ? 'active' : ''  }}" href="{{ route('student.subjects.index')}}">@lang('student.header.subjects')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link  {{ request()->segment(2) == 'account' ? 'active' : ''  }}" href="{{ route('student.account.index') }}">@lang('student.header.my_account')</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="sbout.html">@lang('student.header.about_us')</a>
                                        </li>  
                                        @auth('student')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('logout.student') }}">@lang('student.header.logout')</a>
                                            </li>
                                        @endauth
                                    </ul>
                                    <div class="dropdown">
                                        <a class=" dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                                            @lang('student.header.languages')
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                          @foreach(LaravelLocalization::getSupportedLocales('hideDefaultLocaleInURL = true') as $localeCode => $properties)
                                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--header end-->

@yield('content')

    <!-- Start Footer -->
    <div class="footer">
        <div class="container">
            <div class="row mr-0 ml-0">

                <div class="info col-12 col-lg-5 mb-5">
                    <h2 class="h1 mb-3">@lang('student.site.exam') <span> @lang('student.site.smart')</span></h2>
                        <p> 
                           lorem ipsum dolor sit alermet, consecuter adpesighing elit,sed do eusmod  tempor incidintal ut lubor et dolor e manage aliqui . 
                            lorem ipsum dolor sit alermet, consecuter adpesighing elit,sed do eusmod  tempor incidintal ut lubor et dolor e manage aliqui .
                            lorem ipsum dolor sit alermet, consecuter adpesighing elit,sed do eusmod  tempor incidintal ut lubor et dolor e manage aliqui
                    </p>
                    <i class="fa fa-chevron-circle-right"></i>
                    <a href="#">Read More</a>
                </div>

                <div class="helpful col-12  col-sm-6 col-md-6 col-lg-4 mb-3 pr-lg-0">
                    <h4>Helpful Links</h4>

                    <div class="links row ml-0 mr-0">

                        <div class="col p-0">
                            <ul class="list-unstyled">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Subjects</a></li>
                                <li><a href="#">My Account</a></li>
                            </ul>
                        </div>

                        <div class="col">
                            <ul class="list-unstyled">
                                <li>FAQ</li>
                                <li>Blog</li>
                                <li>How It Work</li>
                                <li>Benefits</li>
                                <li>Contact</li>
                            </ul>
                        </div>

                    </div>

                </div>

                <div class="contact-us col-12 col-sm-6 col-md-6 col-lg-3 mb-3 p-lg-0">
                    <h4>Contact Us</h4>
                    <ul class="list-unstyled">
                        <li>54958 Levo Road Near Red Fort, U.S</li>
                        <li>Phone : 01552163006</li>
                        <li>Email: <a href="#">abdallafathy1023@gmail.com</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- End Footer -->
    <!-- ---------------------------------- -->
    <!-- Start Copy -->
    <div class="copy">
        <div class="container">
            <div class="right text-center pt-3 pb-3">
                Copyright 2022 Smart Exam © All Right Reserved 
            </div>
        </div>
    </div>
    <!-- End Copy -->
    <!-- ---------------------------------- -->

    <!-- latest jquery-->
    <script src="{{ asset('assets_web/js/jquery-3.3.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets_web/js/bootstrap.js') }}"></script>
    <!-- popper js-->
    <script src="{{ asset('assets_web/js/popper.min.js') }}"></script>
    <!-- wow js-->
    <script src="{{ asset('assets_web/js/wow.min.js') }}"></script>
    <!-- lazyload js-->
    <script src="{{ asset('assets_web/js/lazysizes.min.js') }}"></script>
    <!-- script js-->
    <script src="{{ asset('assets_web/js/landing-script.js') }}"></script>
    <!-- Function Get Answer and Add this Answer into inpust Hidden -->
    <script>
        var res;
        $(".select_answer").click(function() {
            res = $(this).parent().parent().parent().find(".form-control").text();
            $(this).parent().parent().parent().parent().find(".answer").val(res);
        });
    </script>
    <script>
        new WOW().init();
    </script>

</body>
</html>