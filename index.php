<?php 
// Incluimos nuestra conexión y hacemos la consulta de todos los clientes
include 'conexion.php';
$busqueda = mysqli_query($conexion, "SELECT * FROM `clientes`");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
<div class="container">
    
    <h2 class="row  d-flex justify-content-center">Administración de clientes</h2>
    <!-- Boton que llama al modal -->
    <button class="row btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar cliente</button>

</div>
<!-- Creamos la tabla donde se muestran los datos-->
<div class="d-flex justify-content-center">
    <div class="w-50">
        <table class="table" id="datatable">
            <thead class="table-light">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Cliente</th>
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
                <td><?php echo $resultado["nombre"]; ?></td>
                <td>
                    <a class="btn btn-secondary" href="direcciones.php?dat=<?php echo $resultado["id"]; ?>">Detalles</a>
                </td>
                <td>
                    <a class="btn btn-danger" href="insertar.php?bo=<?php echo $resultado["id"]; ?>">Eliminar</a>
                </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal para añadir nuevos clientes con sus direcciones-->
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
            <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" name="nombre" id="nombre">
            </div>
        </div>
      </div>
        <table class="table"  id="tabla">
            <tr class="fila-fija">
                <td>
                    <div class="mb-3 row">
                        <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="direccion[]" id="direccion">
                        </div>
                    </div>
                    <input class="btn btn-danger eliminar" id="quitar" type="button" value="Quitar"/>
                </td>     
                        
            </tr>
                    
        </table>
        <div class="row mb-3">
            <div class="col-sm-10">
                <button id="adicional" name="adicional" type="button" class="btn btn-warning">Agregar</button>
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" name="guardar" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>
</form>
</body>
</html>

<script src="assets\index.js?ver=2.3"></script>