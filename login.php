<?php
    session_start();
    $usererror = null;
    $passerror = null;
    $loginerror = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["usuario"])) {
            $usererror = "El usuario es requerido!";
        }else{
            test_value($_POST["usuario"]);
        }

        if (empty($_POST["password"])) {
            $passerror = "El password es requerido!";
        }else {
            test_value($_POST["password"]);
        }
    }

    if(!empty($_POST["usuario"]) && !empty($_POST["password"])){
        if($_POST["sucursal"] == "Astillero"){
            include("Astillero/conexion_astillero.php");
        }elseif ($_POST["sucursal"] == "Gonzalez Leal") {
            include("Gonzalez_Leal/conexion_leal.php");
        }elseif ($_POST["sucursal"] == "Laureles"){
            include("Laureles/conexion_laureles.php");
        }

        $con = mysqli_connect($hostname, $user, $pass, $db) or die("Error al conectar con el servidor...");

        $query = mysqli_query($con, "SELECT * FROM usuarios WHERE USER = '$_POST[usuario]'");
        
        $consulta = mysqli_fetch_array($query, MYSQLI_ASSOC);
        mysqli_close($con);
            
        if($consulta == 0){
            $loginerror = "El usuario no existe!";
        }elseif ($_POST["password"] != $consulta['PASSWORD']) {
            $loginerror = "La contrasena es incorrecta!";
        }else{
            $_SESSION['username'] = $consulta['NOMBRE'];
            $_SESSION['sucursal'] = $_POST["sucursal"];
            if($_POST["sucursal"] == "Astillero"){
                header("Location: Astillero/Menu.php");
            }elseif ($_POST["sucursal"] == "Gonzalez Leal") {
                header("Location: Gonzalez_Leal/Menu.php");
            }elseif ($_POST["sucursal"] == "Laureles"){
                header("Location: Laureles/Menu.php");
            }
        }
    } 

    function test_value($dato){
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>GL Intranet | Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- MORRIS CHART STYLES-->
        <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />        
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <style> .error { color:red;} body{ color:white; }</style>
    </head>

    <body style="background-image:url('GL Body.jpg');">
        <div class="container-fluid" style="background-image:url('GL Body.jpg');">
            <br><br><br><br>
            <hgroup style="text-align:center;">
                <img src="logo.png" alt="GL Intranet">
                <h4>*GL Intranet 2016*</h4>
                <br>
            </hgroup>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <form id="loginForm" action=" <?php $_SERVER["PHP_SELF"] ?>" method="POST">
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" name="usuario" placeholder="Usuario">
                            </div>
                            <span class="error"> <?php echo $usererror; ?></span>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password" placeholder="Contraseña">
                            </div>
                            <span class="error"> <?php echo $passerror; ?></span>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="sucursal">Sucursal</label>
                            <select class="form-control" name="sucursal">
                                <option value="Gonzalez Leal">Gonzalez Leal</option>
                                <option value="Astillero">Astillero</option>
                                <option value="Laureles">Laureles</option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success btn-block">Ingresar</button><br>
                        <span class="error"><?php echo $loginerror ?></span>
                    </form>
                    <br>
                </div>
            </div>
        </div>

        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="assets/js/jquery.metisMenu.js"></script>
        <!-- MORRIS CHART SCRIPTS -->
        <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
        <script src="assets/js/morris/morris.js"></script>
        <!-- CUSTOM SCRIPTS -->
        <script src="assets/js/custom.js"></script>
    </body>
</html>