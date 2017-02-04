<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        <link rel="stylesheet" href="<?= $this->url->getBaseUri(); ?>public/vendor/bootstrap/dist/css/bootstrap.css">
        <link href="<?= $this->url->getBaseUri(); ?>public/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= $this->url->getBaseUri(); ?>public/vendor/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?= $this->url->getBaseUri(); ?>public/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <?= $this->getContent() ?>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="<?= $this->url->getBaseUri(); ?>public/vendor/jquery/dist/jquery.js" ></script>
        <script src="<?= $this->url->getBaseUri(); ?>public/vendor/jquery/dist/jquery.min.js"></script>
        <script src="<?= $this->url->getBaseUri(); ?>public/vendor/bootstrap/dist/js/bootstrap.min.js"></script>      
        <script src="<?= $this->url->getBaseUri(); ?>vendor/ckeditor/ckeditor.js"></script>
    </body>
</html>
