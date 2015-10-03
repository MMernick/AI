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

$cidades_data = file_get_contents($GLOBALS['PATH'].'/registros/cidades.json');
$cidades = json_decode($cidades_data,true);

for($i = 0; $i < count($cidades); $i++){
    echo "<span class=\"glyphicon glyphicon-flag icone\"></span>&nbsp&nbsp&nbsp".$cidades[$i]."<br>";
}

