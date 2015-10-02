<?php
include '../config_path.php';

$str_data = file_get_contents($GLOBALS['PATH'].'/registros/cidades.json');
$data = json_decode($str_data,true);

echo '<option value=""></option>';

for($i = 0; $i < count($data); $i++){
    echo '<option value='.$data[$i].'>'.$data[$i].'</option>';
}

