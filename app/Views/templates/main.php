<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Les Jobs du web</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href='http://fonts.googleapis.com/css?family=Patrick+Hand|Just+Another+Hand|Reenie+Beanie' rel='stylesheet' type='text/css'>
    <!-- Le styles -->
    <link href="http://localhost/doTheJob/web/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/doTheJob/web/assets/css/custom.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px; /* 60px to make the container go all the way to the bottom of the topbar */
        }
    </style>


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>
<div id="wrap">

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about">A propos</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    <div class="nav pull-right"><span class="titleSlogan"> Join the Web !</span></div>
                </div><!--/.nav-collapse -->

            </div>
        </div>
    </div>

    <div class="container mainC">

        <div class="row">
            <div class="col-lg-3"><img src="http://localhost/DoTheJob/web/assets/img/logo_doTheJob.png" width="220px"></div>

            <div class="col-lg-3 col-lg-offset-6">
                <ul class="breadcrumb">
                    <li><a href="?routing=admin/admin/index">Admin</a> <span class="divider">/</span></li>
                </ul>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">

                <?= $content ?>
            </div>
        </div>
    </div> <!-- /container -->


</div>
</body>
</html>