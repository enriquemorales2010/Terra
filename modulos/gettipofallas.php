<?php
require_once __DIR__ . '/../clases/falla.php';

if (!isset($_POST['clase_falla'])) {
    echo "<option value=''>Seleccione una clase de falla primero</option>";
    exit;
}

$clase_falla = intval($_POST['clase_falla']);

$con = new fallas();
$con->buscar($clase_falla);
?>