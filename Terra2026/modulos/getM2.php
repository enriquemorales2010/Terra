<?php

	require '../clases/obs_m2.php';
	$id_proyecto = $_POST['id_proyecto'];

	

	$con = new obs_pro();
    $con->buscare($id_proyecto);


?>