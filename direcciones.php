<?php
// Incluimos nuestra conexion y hacemos la consulta para mostrar las direcciones guardadas
include 'conexion.php';
$busqueda = mysqli_query($conexion, "SELECT * FROM `direcciones` WHERE id_cliente = '".$_REQUEST["dat"]."'");
$id = $_REQUEST["dat"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">  
        <!-- Boton que llama al modal -->  
    <button class="row btn btn-info" id="btnModal" data-bs-toggle="modal" data-bs-target="#exampleModal">Nueva dirección</button>
</div>
<div class="d-flex justify-content-center">
    <div class="w-50">
        <!-- Creamos la tabla donde se muestran los datos-->

        <table class="table" id="datatable">
            <thead class="table-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Direcciones</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
            //Con un ciclo while mostramos todos los datos en la tabla
            $num = 0;
            while ($resultado = mysqli_fetch_assoc($busqueda)) {
                $num++
            ?>
                <tr>
                <th scope="row"><?php echo $num;?></th>
                <td><?php echo $resultado["direccion"]; ?></td>
                <td><a class="btn btn-danger" href="insertar.php?dat=<?php echo $resultado["id"]; ?>">Eliminar</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<a href="index.php" class="btn btn-dark">Volver</a>
</body>
<!-- Modal para añadir nuevas direcciones a un cliente guardado-->
<form action="insertar.php" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Formulario de ingreso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mb-3 row">
            <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
            <div class="col-sm-10">
                <input type="hidden" name="id" id="rar" value="<?php echo $id;?>">
            <input type="text" class="form-control" name="direccion">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" name="direccionar" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
</form>
</html>