<?php
include '../config_path.php';

$str_data = file_get_contents($GLOBALS['PATH'].'/registros/cidades.json');
$data = json_decode($str_data,true);

for($i = 0; $i < count($data); $i++){
    echo "<span class=\"glyphicon glyphicon-flag icone\"></span>&nbsp&nbsp&nbsp".$data[$i]."<br>";
}

