<?php
session_start();
$_SESSION['usuario'] = 'test';
$_SESSION['perfil'] = 'Administrador';
?>
<!DOCTYPE html>
<html>
<head>
    <title>TEST</title>
    <!-- SOLO BOOTSTRAP BÁSICO -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Página de prueba</h1>
        
        <!-- Botón de prueba -->
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#miModal">
            Abrir Modal
        </button>
        
        <!-- Modal de prueba -->
        <div class="modal fade" id="miModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal de prueba</h4>
                    </div>
                    <div class="modal-body">
                        <p>Si ves esto, Bootstrap funciona</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    $(document).ready(function() {
        console.log('jQuery funciona');
        console.log('Bootstrap disponible:', typeof $.fn.modal !== 'undefined');
    });
    </script>
</body>
</html>