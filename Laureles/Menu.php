<?php
    session_start();
    if(empty($_SESSION['username'])){
        header("Location: ../login.php");
    }else{
        $sucursal = $_POST['sucursal'];
?>

<!DOCTYPE html>
    <head>
        <title>GL Intranet | Men&uacute</title>
        <!-- Bootstrap framework -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-ex1-collapse">
                <span class="sr-only">Desplegar navegación</span>
                </button>
                <a class="navbar-brand" href="#" style="color:white">GL Intranet</a>
            </div>
            <p class="navbar-text pull-right" style="color:white">
                Bienvenido <?php echo $_SESSION["username"]; ?>
                <img src="gordito.png" height="30px" width="30px">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <a href="../logout.php" class="navbar-link" style="color:white">Cerrar sesi&oacuten</a>
            </p>
        </nav>

        <header class="jumbotron" style="margin-top: -20px; text-align:center">
            <h1><?php echo $sucursal; ?></h1>        
        </header>
       
        <article class="container" style="text-align:center">
            <p style="font-weight:bold">Seleccione la opci&oacuten deseada:</p>
            <a href="Vehiculos Activos.html" class="btn btn-info btn-lg">Veh&iacuteculos en taller</a>

            <div class="btn-group">
                <button type="button" class="btn btn-info btn-lg">Inventario</button>
                <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Desplegar Men&uacute</span>
                </button>  
                <ul class="dropdown-menu" role="menu">
                    <li><a href="Nuevo Inventario.html">Nuevo inventario</a></li>
                    <li><a href="Buscar Inventario.html">Buscar inventario</a></li>
                    <li><a href="Historico inventarios.php">Hist&oacuterico de inventarios</a></li>
                </ul>             
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-info btn-lg">Presupuestos</button>
                <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Desplegar Men&uacute</span>
                </button>  
                <ul class="dropdown-menu" role="menu">
                    <li><a href="Presupuesto Rapido.html">Nuevo presupuesto r&aacutepido</a></li>
                    <li><a href="Presupuesto Taller.html">Nuevo presupuesto para taller</a></li>
                    <li><a href="Buscar Presupuesto.html">Buscar presupuesto</a></li>
                    <li><a href="Historial Presupuestos.html">Historial de presupuestos</a></li>
                </ul>        
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-info btn-lg">Vales</button>
                <button type="button" class="btn btn-info btn-lg dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Desplegar Men&uacute</span>
                </button>  
                <ul class="dropdown-menu" role="menu">
                    <li><a href="Nuevo Vale.html">Nuevo vale</a></li>
                    <li><a href="Presupuesto Taller.html">Buscar vales</a></li>
                    <li><a href="Historico de Vales.html">Hist&oacuterico de vales</a></li>
                </ul>        
            </div>

            <a href="Gastos.html" class="btn btn-info btn-lg">Gastos</a> 
        </article>
    </body>
</html>
<?php } ?>