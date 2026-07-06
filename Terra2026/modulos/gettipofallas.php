<?php  
require_once '../clases/postventas.php';

// Verificar que llegaron todos los datos
if(isset($_POST['id_falla']) && isset($_POST['caso']) && isset($_POST['descripcion'])) {
    
    $falla = $_POST['id_falla'];
    $caso = $_POST['caso'];
    $descripcion = $_POST['descripcion']; // <-- ESTABA FALTANDO
    $decision = 0;
    $costo = 0;

    $con = new postventas();
    
    // Pasar la descripción a la función
    $con->agregarfal($falla, $caso, $decision, $costo, $descripcion);
    
    // Redireccionar de vuelta al detalle del caso
    header('Location: ../detalle_caso_postventas.php?num_caso=' . $caso . '&mensaje=Falla agregada correctamente');
} else {
    // Si faltan datos, redireccionar con error
    header('Location: ../detalle_caso_postventas.php?num_caso=' . $_POST['caso'] . '&error=Faltan datos requeridos');
}
?>