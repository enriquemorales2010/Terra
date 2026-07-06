<?php

	require '../clases/falla.php';
	
	$elemento = $_POST['elemento'];
	
	$con = new fallas();
    $con->buscarfalla($elemento);


?>