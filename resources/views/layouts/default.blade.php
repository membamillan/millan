<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Online OB</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ URL :: asset('assets2/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL :: asset('assets2/css/landing-page.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ URL :: asset('assets2/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
  @yield('content')
  <footer>
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <ul class="list-inline">
                      <li>
                          <a href="#">Home</a>
                      </li>
                      <li class="footer-menu-divider">&sdot;</li>
                      <li>
                          <a href="#about">About</a>
                      </li>
                      <li class="footer-menu-divider">&sdot;</li>
                      <li>
                          <a href="#services">Services</a>
                      </li>
                      <li class="footer-menu-divider">&sdot;</li>
                      <li>
                          <a href="#contact">Contact</a>
                      </li>
                  </ul>
                  <p class="copyright text-muted small">Copyright &copy; Online  OB 2017. All Rights Reserved</p>
              </div>
          </div>
      </div>
  </footer>

  <!-- jQuery -->
  <script src="{{ URL :: asset('assets2/js/jquery.js') }}"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="{{ URL :: asset('assets2/js/bootstrap.min.js') }}"></script>

</body>

</html>
