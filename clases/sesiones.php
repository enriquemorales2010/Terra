<?php

session_start();

require_once __DIR__ . '/conexion.php';

class Sesiones extends Conexion {

    public function __construct() {
        parent::__construct();
    }

    public function login($usuario, $clave) {
        $stmt = $this->conn->prepare(
            "SELECT usuario.rut_usu, usuario.nom_usu, usuario.ape_usu, usuario.dir_usu, usuario.cor_usu, usuario.clave_usu, usuario.estado, perfil.eti_per " .
            "FROM usuario INNER JOIN perfil ON usuario.id_per = perfil.id_per " .
            "WHERE usuario.cor_usu = ? AND usuario.clave_usu = ?"
        );

        if (!$stmt) {
            die("Error de consulta: " . $this->conn->error);
        }

        $stmt->bind_param('ss', $usuario, $clave);
        $stmt->execute();
        $consulta = $stmt->get_result();

        if (!$consulta) {
            die("Error de ejecución: " . $this->conn->error);
        }

        if ($consulta->num_rows > 0) {
            $fila = $consulta->fetch_assoc();
            $_SESSION['usuario'] = $fila['cor_usu'];
            $_SESSION['pass'] = $fila['clave_usu'];
            $_SESSION['rut'] = $fila['rut_usu'];
            $_SESSION['nombre_usuario'] = $fila['nom_usu'];
            $_SESSION['apellido_usuario'] = $fila['ape_usu'];
            $_SESSION['direccion_usuario'] = $fila['dir_usu'];
            $_SESSION['perfil'] = $fila['eti_per'];
            $_SESSION['estado'] = $fila['estado'];

            if ($_SESSION['perfil'] === "Base") {
                header('Location: ../index2.php');
                exit;
            } elseif ($_SESSION['estado'] == 1) {
                header('Location: ../index.php');
                exit;
            } else {
                session_destroy();
                header('Location: ../error_login.php?error=true');
                exit;
            }
        } else {
            header('Location: ../error_login.php?error=false');
            exit;
        }
    }
}

?>
