<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Sign In - Price Tracker</title>
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
        #signin-demo {
            position: fixed;
            right: 0;
            bottom: 0;
            z-index: 10000;
            background: rgba(0,0,0,.6);
            padding: 6px;
            border-radius: 3px;
        }
        #signin-demo img { cursor: pointer; height: 40px; }
        #signin-demo img:hover { opacity: .5; }
        #signin-demo div {
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
<body class="theme-default page-signin">

<script>
    var init = [];
</script>
{{--<!-- Demo script --> <script src="{{asset('/')}}assets/demo/demo.js"></script> <!-- / Demo script -->--}}

<!-- Page background -->
<div id="page-signin-bg">
    <!-- Background overlay -->
    <div class="overlay"></div>
    <!-- Replace this with your bg image -->
    <img src="{{asset('/')}}assets/demo/signin-bg-1.jpg" alt="">
</div>
<!-- / Page background -->

<!-- Container -->
<div class="signin-container">

    <!-- Left side -->
    <div class="signin-info">
        <a href="index.html" class="logo">
            Price<span style="font-weight:100;">Tracker</span>
        </a> <!-- / .logo -->
        <div class="slogan">
            Simple. Flexible. Powerful.
        </div> <!-- / .slogan -->
        <ul>
            <li><i class="fa fa-sitemap signin-icon"></i> Track of Unlimited Product</li>
            <li><i class="fa fa-file-text-o signin-icon"></i> Get Quick Notification</li>
            <li><i class="fa fa-outdent signin-icon"></i>Easy and Simple Access </li>

        </ul> <!-- / Info list -->
    </div>
    <!-- / Left side -->

    <!-- Right side -->
    <div class="signin-form">
        <br/>
        <form method="POST" action="{{route('post:reset-password')}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="remember_token" value="{{ $token }}">

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <h3>Reset Password Form</h3>
            <hr/>
            <div class="form-group w-icon">
                <input type="password" name="password" id="username_id" class="form-control input-lg" placeholder="Enter New Password">
                <span class="fa fa-lock signin-form-icon"></span>
            </div> <!-- / Username -->

            <div class="form-group w-icon">
                <input type="password" name="confirmpassword" id="password_id" class="form-control input-lg" placeholder="Confirm Password">
                <span class="fa fa-lock signin-form-icon"></span>
            </div>
            <div class="form-actions">
                <input type="submit" value="Reset" class="signin-btn bg-primary">
            </div>
        </form>







    <!-- / "Sign In with" block -->

        <!-- Password reset form -->
        <div class="password-reset-form" id="password-reset-form">
            <div class="header">
                <div class="signin-text">
                    <span>Password reset</span>
                    <div class="close">&times;</div>
                </div> <!-- / .signin-text -->
            </div> <!-- / .header -->

            <!-- Form -->
            <form action="{{route('resetPassword')}}" id="password-reset-form_id" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group w-icon">
                    <input type="text" name="email" id="p_email_id" class="form-control input-lg" placeholder="Enter your email">
                    <span class="fa fa-envelope signin-form-icon"></span>
                </div> <!-- / Email -->

                <div class="form-actions">
                    <input type="submit" value="SEND PASSWORD RESET LINK" class="signin-btn bg-primary">
                </div> <!-- / .form-actions -->
            </form>
            <!-- / Form -->
        </div>
        <!-- / Password reset form -->
    </div>
    <!-- Right side -->
</div>
<!-- / Container -->

<div class="not-a-member">
    Not a member? <a href="{{route('register')}}">Sign up now</a>
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
        var $ph  = $('#page-signin-bg'),
                $img = $ph.find('> img');

        $(window).on('resize', function () {
            $img.attr('style', '');
            if ($img.height() < $ph.height()) {
                $img.css({
                    height: '100%',
                    width: 'auto'
                });
            }
        });
    });

    // Show/Hide password reset form on click
    init.push(function () {
        $('#forgot-password-link').click(function () {
            $('#password-reset-form').fadeIn(400);
            return false;
        });
        $('#password-reset-form .close').click(function () {
            $('#password-reset-form').fadeOut(400);
            return false;
        });
    });

    // Setup Sign In form validation
    init.push(function () {
        $("#signin-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });

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
    });

    // Setup Password Reset form validation
    init.push(function () {
        $("#password-reset-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });

        // Validate email
        $("#p_email_id").rules("add", {
            required: true,
            email: true
        });
    });

    window.LanderApp.start(init);
</script>

</body>
</html>
