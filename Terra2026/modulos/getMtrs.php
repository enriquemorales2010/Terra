<?php

	require '../clases/obs_m2.php';

	$apto = $_POST['apto'];

	$con = new obs_pro();
    $con->buscarM2($apto);


?>