<?php
include '../config_path.php';

$str_data = file_get_contents($GLOBALS['PATH'].'/registros/vincular_cidades.json');
$data = json_decode($str_data,true);

echo json_encode($data);
exit;
for($i = 0; $i < count($data); $i++){
    echo "<span class=\"glyphicon glyphicon-flag icone\"></span> <a onclick=\"deleta_cidades('".$data[$i]["CIDADES"]."')\">".$data[$i]["CIDADES"]."</a><br>";
}

