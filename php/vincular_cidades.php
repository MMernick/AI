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
error_reporting( E_ALL ^E_NOTICE );

$cidade_atual    = $_GET['cidade_atual'];
$cidade_destino  = $_GET['cidade_destino'];
$cidade_km       = $_GET['cidade_km'];

$controle       = FALSE;
$path           = $GLOBALS['PATH'].'/registros/vincular_cidades.json';
$path_inverso   = $GLOBALS['PATH'].'/registros/vincular_cidades_inverso.json';

$arquivo = file_get_contents($path);
$dados = json_decode($arquivo, true);

$arquivo_inv = file_get_contents($path_inverso);
$dados_inv = json_decode($arquivo_inv, true);

$merge = array_merge_recursive($dados, $dados_inv);

if(array_key_exists ($cidade_atual , $merge) && array_key_exists ($cidade_destino , $merge)){
    for($i = 0; $i < count($merge); $i++){
        if($merge[$cidade_atual][$i]['CIDADE'] == $cidade_atual && $merge[$cidade_atual][$i]['DESTINO'] == $cidade_destino){
            $controle = TRUE;
            $mensagem = 'Cidades já Vinculadas!';
            break;
        }
    }
}

if($controle == FALSE){
    $dados[$cidade_atual][]         = ['CIDADE' => $cidade_atual, 'DESTINO' => $cidade_destino, 'KM' => $cidade_km];
    $dados_inv[$cidade_destino][]   = ['CIDADE' => $cidade_destino, 'DESTINO' => $cidade_atual, 'KM' => $cidade_km];

    if(file_put_contents($path,json_encode($dados)) && file_put_contents($path_inverso,json_encode($dados_inv))){
        $mensagem = 'Cidades Vinculadas';
    }else{
        $mensagem = 'Erro ao Vincular Cidades';
    }
}
echo $mensagem;