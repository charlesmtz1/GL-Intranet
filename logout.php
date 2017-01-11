<?php 
    session_start();
    session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link href="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css" rel="stylesheet"></link>
        <style> .error { color:red;} body{ color:white; }</style>
    </head>
    <body style="background-image:url('GL Body.jpg');">
        <div class="container-fluid" style="background-image:url('GL Body.jpg');">
            <h1>Haz salido del sistema!</h1>
            <a href="login.php"><button class="btn btn-success btn-block">Aceptar</button></a>
        </div>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
    </body>
</html>