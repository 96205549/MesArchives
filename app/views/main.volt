<!DOCTYPE html>
<html>
    <head>
       
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        <link href="<?= $this->url->getBaseUri(); ?>public/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= $this->url->getBaseUri(); ?>public/vendor/bootstrap/dist/css/bootstrap.css">
        <link href="<?= $this->url->getBaseUri(); ?>public/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= $this->url->getBaseUri(); ?>public/vendor/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?= $this->url->getBaseUri(); ?>public/css/new.css" rel="stylesheet">
    </head>
    <body class="bod">
        <div class="container-fuild">
        <nav class="navbar navbar-inverse navcol  navbar-fixed-top col-md-12">
           <div class="container-fluid">
                <div class="navbar-header">
                <!--button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button-->
                <a class="navbar-brand" href="<?= $this->url->get("session/logout"); ?>">ElectroArchives</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <!--ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul-->
            </div>
        </div>
    </nav>
          {{ content() }}
         
      </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?= $this->url->getBaseUri(); ?>public/vendor/jquery/dist/jquery.js" ></script>
        <script src="<?= $this->url->getBaseUri(); ?>public/vendor/jquery/dist/jquery.min.js"></script>
        <script src="<?= $this->url->getBaseUri(); ?>public/vendor/bootstrap/dist/js/bootstrap.min.js"></script>      
        <script src="<?= $this->url->getBaseUri(); ?>vendor/ckeditor/ckeditor.js"></script>
    </body>
</html>



