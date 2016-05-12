<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title><?php echo $this->browser_title; ?></title>

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
        <meta name="mobile-web-app-capable" content="yes">

        <meta name="theme-color" content="#009898">

        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/dist/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="/dist/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/dist/css/studotaa.min.css">
        <link rel="stylesheet" href="/dist/css/roc-skin.min.css">
        <!-- Pace -->
        <link rel="stylesheet" href="/plugins/pace/pace.min.css">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition roc-skin layout-top-nav">
        <div class="wrapper">
            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="/" class="navbar-brand"><i class="fa fa-bullseye fa-lg"></i>&nbsp; Studo<b>TAA</b></a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                                <li><a href="#">Link</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <form class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                                </div>
                            </form>
                        </div><!-- /.navbar-collapse -->
                        <!-- Navbar Right Menu -->
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-search margin-r-5"></i>Zoeken</a></li>
                                <!-- User Account Menu -->
                                <li class="dropdown user user-menu">
                                    <!-- Menu Toggle Button -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <!-- The user image in the navbar-->
                                        <img src="https://github.com/tvisser.png" class="user-image" alt="User Image">
                                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                        <span class="hidden-xs">Thoby Visser</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- The user image in the menu -->
                                        <li class="user-header">
                                            <img src="https://github.com/tvisser.png" class="img-circle" alt="User Image">
                                            <p>
                                                Thoby Visser
                                                <small>Web Developer</small>
                                            </p>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <div class="pull-left">
                                                <a href="#" class="btn btn-default btn-flat"><Instellingen></Instellingen></a>
                                            </div>
                                            <div class="pull-right">
                                                <a href="#" class="btn btn-default btn-flat">Uitloggen</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- /.navbar-custom-menu -->
                    </div><!-- /.container-fluid -->
                </nav>
            </header>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <div class="container">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <?php if(!empty($this->title)) { ?>
                            <h1>
                                <?php echo $this->title; ?>
                                <small><?php echo $this->description; ?></small>
                            </h1>
                        <?php } ?>
                        <!--<ol class="breadcrumb">
                            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Here</li>
                        </ol>-->
                    </section>

                    <!-- Main content -->
                    <section class="content">

                        <?php require_once('application/views/' . $_view . '.php'); ?>

                    </section><!-- /.content -->
                </div><!-- /.container -->
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="container">
                    <div class="pull-right hidden-xs">
                        <a class="btn btn-social-icon btn-dropbox" href="/informatie" title="Bekijk meer informatie over de applicatie." data-toggle="tooltip" data-original-title="Verkrijg meer informatie over de applicatie.."><i class="fa fa-info"></i></a>
                        <a class="btn btn-social-icon btn-github" href="https://github.com/tvisser/StudoTAA" title="Bekijk StudoTAA's broncode en documentatie op GitHub." data-toggle="tooltip" data-original-title="Bekijk StudoTAA's broncode en documentatie op GitHub." target="_blank"><i class="fa fa-github"></i></a>
                    </div>
                    <strong style="line-height: 34px">Copyright &copy; 2015-<?php echo date("Y"); ?> <small><span class="hidden-xs">ontwikkeld </span>door</small> <a href="http://thoby.nl" target="_blank">Thoby Visser</a><span class="hidden-xs"> - <a href="http://roc-teraa.nl/" target="_blank">ROC ter AA</a></span>.</strong>
                </div><!-- /.container -->
            </footer>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="/bootstrap/js/bootstrap.min.js"></script>
        <!-- StudoTAA JS File -->
        <script src="/dist/js/app.min.js"></script>
        <!-- FastClick -->
        <script src="/plugins/fastclick/fastclick.min.js"></script>
        <!-- SlimScroll -->
        <script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- Pace -->
        <script src="/plugins/pace/pace.min.js"></script>
        <script type="text/javascript"> $(document).ajaxStart(function() { Pace.restart(); }); </script>

        <?php if(!empty($this->footer)) require_once('application/views/' . $this->footer . '.php'); ?>

    </body>
</html>
