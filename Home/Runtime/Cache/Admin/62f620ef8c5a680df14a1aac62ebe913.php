<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>Metronic | Login Page</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="/personal/Public/css/Admin/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link href="/personal/Public/css/Admin/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

    <link href="/personal/Public/css/Admin/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <link href="/personal/Public/css/Admin/style-metro.css" rel="stylesheet" type="text/css"/>

    <link href="/personal/Public/css/Admin/style.css" rel="stylesheet" type="text/css"/>

    <link href="/personal/Public/css/Admin/style-responsive.css" rel="stylesheet" type="text/css"/>

    <link href="/personal/Public/css/Admin/default.css" rel="stylesheet" type="text/css" id="style_color"/>

    <link href="/personal/Public/css/Admin/uniform.default.css" rel="stylesheet" type="text/css"/>

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->

    <link href="/personal/Public/css/Admin/login.css" rel="stylesheet" type="text/css"/>

    <!-- END PAGE LEVEL STYLES -->

    <link rel="shortcut icon" href="/personal/Public/images/Admin/myico.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="login">

<!-- BEGIN LOGO -->

<div class="logo">

    <img src="/personal/Public/images/Admin/logo-big.png" alt="" />

</div>

<!-- END LOGO -->

<!-- BEGIN LOGIN -->

<div class="content">

    <!-- BEGIN LOGIN FORM -->

    <h3 class="form-title">Login to Managerment</h3>
    <form method="post">

        <div class="control-group">
            <div class="controls">
                <div class="input-icon left">

                    <input class="m-wrap placeholder-no-fix username" name="userName" type="text" placeholder="Username"/>

                </div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <div class="input-icon left">

                    <input class="m-wrap placeholder-no-fix password" name="password" type="password" placeholder="Password"/>

                </div>
            </div>
        </div>

        <div class="form-actions">
            <label class="checkbox">
                <a href="<?php echo U('Home/Index/Index');?>" class="btn blue pull-left" >back</a>
            </label>
            <button type="submit" class="btn green pull-right" style="margin-top: 8px;">login</button>
        </div>
    </form>

    <!-- END LOGIN FORM -->

</div>

<!-- END LOGIN -->

<!-- BEGIN COPYRIGHT -->

<div class="copyright">

    2016 &copy; Chiu . Admin

</div>

<!-- END COPYRIGHT -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<script src="/personal/Public/js/Admin/jquery-1.10.1.min.js" type="text/javascript"></script>

<script src="/personal/Public/js/Admin/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="/personal/Public/js/Admin/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="/personal/Public/js/Admin/bootstrap.min.js" type="text/javascript"></script>

<!--[if lt IE 9]>

<script src="/personal/Public/js/Admin/excanvas.min.js"></script>

<script src="/personal/Public/js/Admin/respond.min.js"></script>

<![endif]-->

<script src="/personal/Public/js/Admin/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="/personal/Public/js/Admin/jquery.blockui.min.js" type="text/javascript"></script>

<script src="/personal/Public/js/Admin/jquery.cookie.min.js" type="text/javascript"></script>

<script src="/personal/Public/js/Admin/jquery.uniform.min.js" type="text/javascript" ></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="/personal/Public/js/Admin/jquery.validate.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="/personal/Public/js/Admin/app.js" type="text/javascript"></script>

<script src="/personal/Public/js/Admin/login.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

    jQuery(document).ready(function() {

        App.init();

        Login.init();

    });

//    $('.pull-right').click(function(){
//        var username = $('.username').val();
//        var password = $('.password').val();
//        $.ajax({
//            url: "<?php echo U('Admin/Admin/Index');?>",
//            dataType: 'json',
//            type: 'post',
//            data: {fdName:username, fdPassword:password},
//            success: function(re){
//
//            }
//        })
//    })

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>