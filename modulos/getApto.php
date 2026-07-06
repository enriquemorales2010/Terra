<?php

	require '../clases/obs_m2.php';

	$id_proyecto = $_POST['id_proyecto'];
	$piso = $_POST['piso'];

	$con = new obs_pro();
    $con->buscarapto($id_proyecto, $piso);


?>