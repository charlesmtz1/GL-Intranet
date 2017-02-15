<?php
    include("conexion_leal.php");

    $con = mysqli_connect($hostname, $user, $pass, $db) or die("Error al conectar con el servidor");

    $query = mysqli_query($con, "SELECT * FROM clientes") or die("No se pudo realizar la consulta");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>GL Intranet | Hist&oacuterico de inventarios</title>
        <!-- Bootstrap framework -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header class="jumbotron" style="margin-top: -20px; text-align:center">
            <h1>Hist&oacuterico de inventarios</h1>        
        </header>
        
        <article class="container" style="text-align:center">
            <table class="table table-striped">
                <thead style="text-align:center">
                    <tr>
                        <th>Folio</th>
                        <th>Nombre</th>
                        <th>Domicilio</th>
                        <th>Colonia</th>
                        <th>Municipio</th>
                        <th>R.F.C.</th>
                        <th>Telefono</th>
                        <th>Celular</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td><?php echo $row['FOLIO'] ?></td>
                                <td><?php echo $row['NOMBRE'] ?></td>
                                <td><?php echo $row['DOMICILIO'] ?></td>
                                <td><?php echo $row['COLONIA'] ?></td>
                                <td><?php echo $row['MUNICIPIO'] ?></td>
                                <td><?php echo $row['RFC'] ?></td>
                                <td><?php echo $row['TELEFONO'] ?></td>
                                <td><?php echo $row['CELULAR'] ?></td>
                                <td><?php echo $row['EMAIL'] ?></td>
                            </tr>
                        <?php } ?>
                 </tbody>
             </table>
             <div class="col-sm-12" style="text-align:center">
                <a href="Menu.html"><button class="btn btn-info">Aceptar</button></a>    
             </div>
        </article>
    </body>
</html>