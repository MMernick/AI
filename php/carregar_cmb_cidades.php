<?php
/**
 * FACULDADE ANHANGUERA DE BAURU
 * CIÊNCIAS DA COMPUTAÇÃO
 * 
 * INTELIGÊNCIA ARTIFICIAL
 * ALGORITIMO ARAD/BUCHAREST
 * 
 * CRIADO POR:  MATHEUS MERNICK
 * EMAIL:       mernick@live.com
 * DATA:        03/10/2015
 */

include '../config_path.php';

$str_data = file_get_contents($GLOBALS['PATH'].'/registros/cidades.json');
$data = json_decode($str_data,true);

sort($data);
echo '<option value=""></option>';

for($i = 0; $i < count($data); $i++){
    echo '<option value='.$data[$i].'>'.$data[$i].'</option>';
}

