<!-- ARCHIVO DE ACCIONES-->
<?php
include 'conexion.php';
// Verificamos si hay un envio para guardar y pasamos a insertar todo en la base de datos
if (isset($_POST["guardar"])) {
    $nombre = $_POST['nombre'];
    $items2 = $_POST['direccion'];
    $direccion_actual = current($items2);
    
    mysqli_query($conexion, "INSERT INTO `clientes` (`id`, `nombre`) VALUES (NULL, '$nombre')");
    $id= $conexion->insert_id;
      while(true) {  
      //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
      $item2 = current($items2);
     
  
          ////// ASIGNARLOS A VARIABLES ///////////////////
      $direccion=(( $item2 !== false) ? $item2 : ", &nbsp;");
      
      
          //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
      $valores='("'.$id.'","'.$direccion.'"),';  
          ////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA ////
      $valoresQ= substr($valores, 0, -1);
  
          ///////// QUERY DE INSERCIÓN ////////////////////////////
          $sql = "INSERT INTO `direcciones` (`id_cliente`, `direccion`) VALUES $valoresQ";
          mysqli_query($conexion, $sql);
  
          // Up! Next Value
      $item2 = next( $items2 );
      
  
      // Check terminator
      if($item2 === false){
        header("Location: ".$_SERVER['HTTP_REFERER']."");
        break;
      };
    }
  }
  /* Verificamos si se esta haciendo un request y en caso de que si, realizamos la accion,
   en este caso, eliminar una dirección guardada */
  if (isset($_REQUEST["dat"])) {
    mysqli_query($conexion, "DELETE FROM `direcciones` WHERE id = '".$_REQUEST["dat"]."'");
    header("Location: ".$_SERVER['HTTP_REFERER']."");
  }
    /* Verificamos si se esta haciendo un envio y en caso de que si,
    realizamos la accion, en este caso, insertar una nueva dirección al cliente guardado */
  if (isset($_POST["direccionar"])) {
    $id = $_POST["id"];
    $direccion = $_POST['direccion'];
    mysqli_query($conexion, "INSERT INTO `direcciones` (`id`, `id_cliente`, `direccion`) VALUES
    (NULL, '$id', '$direccion')");
    header("Location: ".$_SERVER['HTTP_REFERER']."");
  }
  /* Verificamos si se esta haciendo un request y en caso de que si, realizamos la accion,
   en este caso, eliminar un cliente guardado */
  if (isset($_REQUEST["bo"])) {
    mysqli_query($conexion, "DELETE FROM `clientes` WHERE id = '".$_REQUEST["bo"]."'");
    header("Location: ".$_SERVER['HTTP_REFERER']."");
  }
?>