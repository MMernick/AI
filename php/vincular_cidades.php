<?php
include '../config_path.php';

$cidade_atual    = $_GET['cidade_atual'];
$cidade_destino  = $_GET['cidade_destino'];
$cidade_km       = $_GET['cidade_km'];

$path           = $GLOBALS['PATH'].'/registros/vincular_cidades.json';
$path_inverso   = $GLOBALS['PATH'].'/registros/vincular_cidades_inverso.json';

$arquivo = file_get_contents($path);
$dados = json_decode($arquivo, true);

$arquivo_inv = file_get_contents($path_inverso);
$dados_inv = json_decode($arquivo_inv, true);


$dados[$cidade_atual][]         = ['CIDADE' => $cidade_atual, 'DESTINO' => $cidade_destino, 'KM' => $cidade_km];
$dados_inv[$cidade_destino][]   = ['CIDADE' => $cidade_destino, 'DESTINO' => $cidade_atual, 'KM' => $cidade_km];

if(file_put_contents($path,json_encode($dados)) && file_put_contents($path_inverso,json_encode($dados_inv))){
    $mensagem = 'Cidades Vinculadas / Editadas com Sucesso!';
}else{
    $mensagem = 'Erro ao Vincular / Editar Cidades!';
}
echo $mensagem;