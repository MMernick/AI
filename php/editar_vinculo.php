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

$cidade     = $_GET['cidade'];
$destino    = $_GET['destino'];
$km         = $_GET['km'];

$path           = $GLOBALS['PATH'].'/registros/vincular_cidades.json';
$path_inverso   = $GLOBALS['PATH'].'/registros/vincular_cidades_inverso.json';

$arquivo = file_get_contents($path);
$dados = json_decode($arquivo, true);

$arquivo_inv = file_get_contents($path_inverso);
$dados_inv = json_decode($arquivo_inv, true);

for($i = 0; $i < $dados[$cidade]; $i++){
    if($dados[$cidade][$i]['CIDADE'] == $cidade && $dados[$cidade][$i]['DESTINO'] == $destino){
        $dados[$cidade][$i]['KM'] = $km;
        break;
    }
}

for($j = 0; $j < $dados_inv[$destino]; $j++){
    if($dados_inv[$destino][$j]['CIDADE'] == $destino && $dados_inv[$destino][$j]['DESTINO'] == $cidade){
        $dados_inv[$destino][$j]['KM'] = $km;
        break;
    }
}

file_put_contents($path,json_encode($dados));
file_put_contents($path_inverso,json_encode($dados_inv));


