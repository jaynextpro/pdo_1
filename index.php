<?php 
    include_once('./conf/con.php');
    session_start();

    $sentencia = $pdo->prepare("SELECT * FROM medicamentos");
    $sentencia->execute();
    $medicamentos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>PDO 1 DWSL(U20192080)</title>
    </head>
    <body style="text-align: center;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Mi Sitio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

    
        <div class="container mt-5">
            <h2 class="text-center">Medicamentos</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Existencia</th>
                            <th>Fecha de registro</th>
                            <th>Precio</th>
                            <th>Imagen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($medicamentos as $medicamento) {
                                echo "<tr>
                                    <td>". $medicamento["codigo"] ."</td>
                                    <td>". $medicamento["nombre"] ."</td>
                                    <td>". $medicamento["existencia"] ."</td>
                                    <td>". $medicamento["fecharegistro"] ."</td>
                                    <td>". $medicamento["precio"] ."</td>
                                    <td><img src='img/". $medicamento["imagen"] ."' width='50' height='50' title=". $medicamento["nombre"] ."' alt='". $medicamento["nombre"] ."'></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>

                <a href="insertar.php" class="btn btn-primary" role="button">Agregar medicamento</a>
            </div>
            <?php 
                if(isset($_SESSION["noticia"])) {
                    echo "<div class='alert alert-secondary' role='alert'>
                        ".  $_SESSION["noticia"] . "
                    </div>";
                }

                unset($_SESSION["noticia"]);
            ?>
        </div>


    </body>
</html>