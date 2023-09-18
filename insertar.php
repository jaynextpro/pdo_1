<?php 
    include_once('./conf/con.php');
    session_start();

    if (isset($_POST["accion"])) {
        $sentencia = $pdo->prepare("INSERT INTO medicamentos (nombre, existencia, precio, imagen) VALUES (?, ?, ?, ?)");
        $sentencia->bindParam(1, $_POST["nombre"]);
        $sentencia->bindParam(2, $_POST["existencia"]);
        $sentencia->bindParam(3, $_POST["precio"]);

        if (isset($_FILES["imagen"])) { 
            $ruta_imagenes = "img/";
            $origen = $_FILES["imagen"]["tmp_name"];
            $destino = $ruta_imagenes . $_FILES["imagen"]["name"];

            if (move_uploaded_file($origen, $destino)) {
                $sentencia->bindParam(4, $_FILES["imagen"]["name"]);
            } else {
                $imagen_vacia = "";
                $sentencia->bindParam(4, $imagen_vacia);
            }
        } else {
            $imagen_vacia = "";
            $sentencia->bindParam(4, $imagen_vacia);
        }

        if ($sentencia->execute()) {
            $_SESSION["noticia"] = "Se ha agregado el medicamento correctamente";

            header("Location: index.php");
        }
    }
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
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="text-center">Agregar medicamento</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input name="nombre" type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="existencia" class="form-label">Existencia</label>
                            <input name="existencia" type="text" class="form-control" id="existencia">
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input name="precio" type="text" class="form-control" id="precio">
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input name="imagen" type="file" class="form-control" id="imagen">
                        </div>
                        <button type="submit" class="btn btn-primary" name="accion" value="insertar">Agregar</button>
                        <a href="index.php" class="btn btn-primary" role="button">Cancelar</a>
                    </form>
                </div>
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
 <!-- Incluye Bootstrap JS (jQuery y Popper.js son necesarios) -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/js/bootstrap.min.js"></script>