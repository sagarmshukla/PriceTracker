<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Sign Up - Price Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <!-- Open Sans font from Google CDN -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&amp;subset=latin" rel="stylesheet" type="text/css">

    <!-- LanderApp's stylesheets -->
    <link href="{{asset('/')}}assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/stylesheets/landerapp.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
    <link href="{{asset('/')}}assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
    <script src="{{asset('/')}}assets/javascripts/ie.min.js"></script>
    <![endif]-->


    <!-- $DEMO =========================================================================================

        Remove this section on production
    -->
    <style>
        #signup-demo {
            position: fixed;
            right: 0;
            bottom: 0;
            z-index: 10000;
            background: rgba(0,0,0,.6);
            padding: 6px;
            border-radius: 3px;
        }
        #signup-demo img { cursor: pointer; height: 40px; }
        #signup-demo img:hover { opacity: .5; }
        #signup-demo div {
            color: #fff;
            font-size: 10px;
            font-weight: 600;
            padding-bottom: 6px;
        }
    </style>
    <!-- / $DEMO -->

</head>


<!-- 1. $BODY ======================================================================================

	Body

	Classes:
	* 'theme-{THEME NAME}'
	* 'right-to-left'     - Sets text direction to right-to-left
-->
<body class="theme-default page-signup">

<script>
    var init = [];
</script>
<!-- Demo script --> <script src="{{asset('/')}}assets/demo/demo.js"></script> <!-- / Demo script -->

<!-- Page background -->
<div id="page-signup-bg">
    <!-- Background overlay -->
    <div class="overlay"></div>
    <!-- Replace this with your bg image -->
    <img src="{{asset('/')}}assets/demo/signin-bg-1.jpg" alt="">
</div>
<!-- / Page background -->

<!-- Container -->
<div class="signup-container">
    <!-- Header -->
    <div class="signup-header">
        <a href="index.html" class="logo">
            Price<span style="font-weight:100;">Tracker</span>
        </a> <!-- / .logo -->
        <div class="slogan">
            Simple. Flexible. Powerful.
        </div> <!-- / .slogan -->
    </div>
    <!-- / Header -->

    <!-- Form -->
    <div class="signup-form">
        <form action="{{route('post:register')}}" id="signup-form_id" method="post">
            @if ($errors->has())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            @if(Session::has('register-successful'))
                <p class="alert alert-success">{{Session::get('register-successful')}}</p>
            @endif
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="signup-text">
                <span>Create an account</span>
            </div>

            <div class="form-group w-icon">
                <input type="text" name="name" id="name_id" class="form-control input-lg" placeholder="Full name">
                <span class="fa fa-info signup-form-icon"></span>
            </div>

            <div class="form-group w-icon">
                <input type="text" name="email" id="email_id" class="form-control input-lg" placeholder="E-mail">
                <span class="fa fa-envelope signup-form-icon"></span>
            </div>

            <div class="form-group w-icon">
                <input type="password" name="password" id="password_id" class="form-control input-lg" placeholder="Password">
                <span class="fa fa-lock signup-form-icon"></span>
            </div>

            <div class="form-group" style="margin-top: 20px;margin-bottom: 20px;">
                <label class="checkbox-inline">
                    <input type="checkbox" name="signup_confirm" class="px" id="confirm_id">
                    <span class="lbl">I agree with the <a href="#" target="_blank">Terms and Conditions</a></span>
                </label>
            </div>

            <div class="form-actions">
                <input type="submit" value="SIGN UP" class="signup-btn bg-primary">
            </div>
        </form>
        <!-- / Form -->

        <!-- "Sign In with" block -->
        <div class="signup-with">
            <!-- Facebook -->
            <a href="{{route('social', 'facebook')}}" class="signup-with-btn" style="background:#4f6faa;background:rgba(79, 111, 170, .8);">Sign Up with <span>Facebook</span></a>
        </div>
        <!-- / "Sign In with" block -->
    </div>
    <!-- Right side -->
</div>

<div class="have-account">
    Already have an account? <a href="{{route('login')}}">Sign In</a>
</div>


<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
<script type="text/javascript"> window.jQuery || document.write('<script src="{{asset('/')}}assets/javascripts/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
<script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- LanderApp's javascripts -->
<script src="{{asset('/')}}assets/javascripts/bootstrap.min.js"></script>
<script src="{{asset('/')}}assets/javascripts/landerapp.min.js"></script>

<script type="text/javascript">
    // Resize BG
    init.push(function () {
        $("#signup-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });

        // Validate name
        $("#name_id").rules("add", {
            required: true,
            minlength: 1
        });

        // Validate email
        $("#email_id").rules("add", {
            required: true,
            email: true
        });

        // Validate username
        $("#username_id").rules("add", {
            required: true,
            minlength: 3
        });

        // Validate password
        $("#password_id").rules("add", {
            required: true,
            minlength: 5
        });

        // Validate confirm checkbox
        $("#confirm_id").rules("add", {
            required: true
        });
    });

    window.LanderApp.start(init);
</script>

</body>
</html>
