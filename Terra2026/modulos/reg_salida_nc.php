<?php
require '../clases/salida_nc.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Acceso no permitido.');
}

$id_s           = trim($_POST['id_s'] ?? '');
$area           = trim($_POST['area'] ?? '');
$accion_a       = trim($_POST['accion_a'] ?? '');
$etapa          = trim($_POST['etapa'] ?? '');
$ubicacion      = trim($_POST['ubicacion'] ?? '');
$proyecto       = trim($_POST['proyecto'] ?? '');
$desc_sal_1     = trim($_POST['desc_sal_1'] ?? '');
$evidencia_1    = trim($_POST['evidencia_1'] ?? '');
$nom_enc_1      = trim($_POST['nom_enc_1'] ?? '');
$funcion_1      = trim($_POST['funcion_1'] ?? '');
$origen_1       = trim($_POST['origen_1'] ?? '');
$fecha_sa_1     = trim($_POST['fecha_sa_1'] ?? '');
$desc_ac_in_2   = trim($_POST['desc_ac_in_2'] ?? '');
$nom_enc_2      = trim($_POST['nom_enc_2'] ?? '');
$funcion_2      = trim($_POST['funcion_2'] ?? '');
$fecha_ac_in_2  = trim($_POST['fecha_ac_in_2'] ?? '');
$desc_ana_eva_3 = trim($_POST['desc_ana_eva_3'] ?? '');
$desc_int_3     = trim($_POST['desc_int_3'] ?? '');
$desc_imple_4   = trim($_POST['desc_imple_4'] ?? '');
$nom_enc_4      = trim($_POST['nom_enc_4'] ?? '');
$funcion_4      = trim($_POST['funcion_4'] ?? '');
$fecha_ac_co_4  = trim($_POST['fecha_ac_co_4'] ?? '');
$aceptacion_5   = trim($_POST['aceptacion_5'] ?? '');
$obs_acep_5     = trim($_POST['obs_acep_5'] ?? '');
$nom_enc_5      = trim($_POST['nom_enc_5'] ?? '');
$fecha_acep_5   = trim($_POST['fecha_acep_5'] ?? '');
$nom_enc_6      = trim($_POST['nom_enc_6'] ?? '');
$funcion_6      = trim($_POST['funcion_6'] ?? '');
$fecha_cie_6    = trim($_POST['fecha_cie_6'] ?? '');
$agregar_m      = trim($_POST['agregar_m'] ?? '');
$estado         = trim($_POST['estado'] ?? '');

$fecha_sa_1     = ($fecha_sa_1 === '' || $fecha_sa_1 === '0') ? '1900-01-01' : $fecha_sa_1;
$fecha_ac_in_2  = ($fecha_ac_in_2 === '' || $fecha_ac_in_2 === '0') ? '1900-01-01' : $fecha_ac_in_2;
$fecha_ac_co_4  = ($fecha_ac_co_4 === '' || $fecha_ac_co_4 === '0') ? '1900-01-01' : $fecha_ac_co_4;
$fecha_acep_5   = ($fecha_acep_5 === '' || $fecha_acep_5 === '0') ? '1900-01-01' : $fecha_acep_5;
$fecha_cie_6    = ($fecha_cie_6 === '' || $fecha_cie_6 === '0') ? '1900-01-01' : $fecha_cie_6;

$origen_1       = ($origen_1 === '' || $origen_1 === '0') ? 0 : $origen_1;
$funcion_1      = ($funcion_1 === '' || $funcion_1 === '0') ? 0 : $funcion_1;
$funcion_2      = ($funcion_2 === '' || $funcion_2 === '0') ? 0 : $funcion_2;
$funcion_4      = ($funcion_4 === '' || $funcion_4 === '0') ? 0 : $funcion_4;
$funcion_6      = ($funcion_6 === '' || $funcion_6 === '0') ? 0 : $funcion_6;
$aceptacion_5   = ($aceptacion_5 === '' || $aceptacion_5 === '0') ? 0 : $aceptacion_5;
$agregar_m      = ($agregar_m === '' || $agregar_m === '0') ? 0 : $agregar_m;
$estado         = ($estado === '' || $estado === '0') ? 0 : $estado;

if ($id_s === '' || $area === '' || $accion_a === '' || $etapa === '' || $ubicacion === '' || $proyecto === '') {
    die('Faltan campos obligatorios.');
}

try {
    $con = new salida_nc();

    $resultado = $con->registrarsalida(
        $id_s,
        $area,
        $accion_a,
        $etapa,
        $ubicacion,
        $desc_sal_1,
        $evidencia_1,
        $nom_enc_1,
        $funcion_1,
        $origen_1,
        $fecha_sa_1,
        $desc_ac_in_2,
        $nom_enc_2,
        $funcion_2,
        $fecha_ac_in_2,
        $desc_ana_eva_3,
        $desc_int_3,
        $desc_imple_4,
        $nom_enc_4,
        $fecha_ac_co_4,
        $funcion_4,
        $aceptacion_5,
        $obs_acep_5,
        $nom_enc_5,
        $fecha_acep_5,
        $nom_enc_6,
        $funcion_6,
        $fecha_cie_6,
        $agregar_m,
        $proyecto,
        $estado
    );

    if ($resultado) {
        header('Location: ../lista_salidanc.php?ok=1');
        exit;
    } else {
        die('No se pudo registrar la salida no conforme.');
    }
} catch (Throwable $e) {
    die('Error al guardar: ' . $e->getMessage());
}
?>