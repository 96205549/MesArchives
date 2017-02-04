<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        <link href="<?= $this->url->getBaseUri(); ?>public/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= $this->url->getBaseUri(); ?>public/vendor/bootstrap/dist/css/bootstrap.css">
        <link href="<?= $this->url->getBaseUri(); ?>public/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= $this->url->getBaseUri(); ?>public/vendor/font-awesome/css/font-awesome.css" rel="stylesheet">
    </head>
    <body class="bod">
        <div class="container-fuild">
            <div class="container-fuild">
    <nav class="navbar navbar-inverse navcol  navbar-fixed-top col-md-12">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#">Mes Archives</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                        <span class="glyphicon glyphicon-user"></span> Joezer <i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu sous-menu" role="menu">
                            <li>
                                <a href="#">&nbsp; Mon profile</a>
                            </li> 
                            <li>
                                <a href="<?= $this->url->get(" "); ?>">&nbsp; D&eacute;connexion</a>
                            </li>                    
                        </ul>
                    </li>
                    
                    <!--li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li-->
                </ul>
            </div>
        </div>
    </nav>
        <div class="container-fuild">
        <div class="col-sm-2 bloc-right fixed" > 
         
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                            </span> Dossier</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-folder-open"></span> <a href="<?= $this->url->get("dashboard/newFolder"); ?>"> Cr&eacute;er un dossier</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-folder-close"></span> <a href="<?= $this->url->get("dashboard/mesFolders"); ?>"> Mes dossiers</a>
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="<?= $this->url->get("dashboard/newFile"); ?>"><span class="glyphicon glyphicon-file">
                            </span> Fichiers </a>
                        </h4>
                    </div>
                    <!--div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                       <span class="glyphicon glyphicon-save-file"></span> <a href="<?= $this->url->get("dashboard/newFile"); ?>">Cr&eacute;er un fichier</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       <span class="glyphicon glyphicon-open-file"></span> <a href="<?= $this->url->get("dashboard/mesFiles"); ?>"></span>Mes fichiers</a>
                                    </td>
                                </tr>                          
                            </table>
                        </div>
                    </div-->
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="<?= $this->url->get("dashboard/newArchive"); ?>"><span class="glyphicon glyphicon-briefcase">
                            </span> Archives</a>
                        </h4>
                    </div>
                    <!--div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-responsive table-triped">
                                <tr class="table table-triped">
                                    <td>
                                       <span class="glyphicon glyphicon-book"></span> <a href="<?= $this->url->get("dashboard/newArchive"); ?>"> Cr&eacute;er une archive</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-bookmark"> </span><a href="<?= $this->url->get("dashboard/mesArchives"); ?>"> Mes Archives</a> 
                                    </td>
                                </tr>
                               
                            </table>
                        </div>
                    </div-->
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-erase">
                            </span> Carnet d&apos; adresse</a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-responsive table-triped">
                                <tr class="table table-triped">
                                    <td>
                                       <span class="glyphicon glyphicon-earphone"></span> <a href="<?= $this->url->get("dashboard/newContact"); ?>"> Cr&eacute;er un contact</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       <span class="glyphicon glyphicon-list-alt"></span> <a href="<?= $this->url->get("dashboard/mesContacts"); ?>"> Mes Contacts</a> 
                                    </td>
                                </tr>                               
                            </table>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive"><span class="glyphicon glyphicon-envelope">
                            </span> Couriel</a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-comment"></span><a href="<?= $this->url->get("dashboard/newMessage"); ?>"> Nouveau</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-cloud-upload"></span><a href="<?= $this->url->get("dashboard/mesMessages"); ?>"> Envoy&eacute;s</a>
                                    </td>
                                </tr>     
                            </table>
                        </div>
                    </div>
                </div>

               
            <!--/div-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix"><span class="glyphicon glyphicon-cog">
                            </span> Param&egrave;tres</a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-user"></span><a href="<?= $this->url->get("dashboard/settings"); ?>"> Systeme</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-user"></span><a href="http://www.jquery2dotnet.com"> Utilisateur</a>
                                    </td>
                                </tr>     
                            </table>
                        </div>
                    </div>
                </div>

                 <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="<?= $this->url->get("dashboard/corbeille"); ?>"><span class="glyphicon glyphicon-trash">
                            </span> Corbeille(50)</a>
                        </h4>
                    </div>      
                </div>
            </div>
       
            
        </div>     
           
        <div class="col-sm-10 bloc-left"> 
          {{ content() }}
        </div>     
    </div>
</div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?= $this->url->getBaseUri(); ?>public/vendor/jquery/dist/jquery.js" ></script>
        <script src="<?= $this->url->getBaseUri(); ?>public/vendor/jquery/dist/jquery.min.js"></script>
        <script src="<?= $this->url->getBaseUri(); ?>public/vendor/bootstrap/dist/js/bootstrap.min.js"></script>      
        <script src="<?= $this->url->getBaseUri(); ?>public/js/archives.js"></script>      
        <script src="<?= $this->url->getBaseUri(); ?>vendor/ckeditor/ckeditor/ckeditor.js"></script>
    </body>
</html>



