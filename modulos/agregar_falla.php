<?php  
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../error_login.php?error=true');
    exit();
}

require_once '../clases/postventas.php';

// Verificar que llegaron todos los datos
if(isset($_POST['id_falla']) && isset($_POST['caso']) && isset($_POST['descripcion'])) {
    
    $falla = $_POST['id_falla'];
    $caso = $_POST['caso'];
    $descripcion = $_POST['descripcion']; // ¡AGREGAMOS LA DESCRIPCIÓN!
    $decision = 0;
    $costo = 0;

    $con = new postventas();
    
    // Llamar a la función con los 5 parámetros
    $resultado = $con->agregarfal($falla, $caso, $decision, $costo, $descripcion);
    
    if($resultado) {
        header('Location: ../postventa_detalles.php?num_caso=' . $caso . '&mensaje=Falla agregada correctamente');
    } else {
        header('Location: ../postventa_detalles.php?num_caso=' . $caso . '&error=Error al agregar la falla');
    }
} else {
    // Si faltan datos, redireccionar con error
    $caso = isset($_POST['caso']) ? $_POST['caso'] : '';
    header('Location: ../postventa_detalles.php?num_caso=' . $caso . '&error=Faltan datos requeridos');
}
?>