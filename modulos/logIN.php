<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['usuario']) || empty($_POST['pass'])) {
    die("Error, no se permite el acceso directo");
}

require_once __DIR__ . '/../clases/sesiones.php';

$usuario = trim($_POST['usuario']);
$clave = trim($_POST['pass']);

$con = new Sesiones();
$con->login($usuario, $clave);

?>
