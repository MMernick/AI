<?php
include '../config_path.php';

$cidade_atual    = $_GET['cidade_atual'];
$cidade_destino  = $_GET['cidade_destino'];
$cidade_km       = $_GET['cidade_km'];

$existe         = FALSE;
$path           = $GLOBALS['PATH'].'/registros/vincular_cidades.json';

$arquivo = file_get_contents($path);
$dados = json_decode($arquivo, true);

if(!empty($dados[$cidade_atual])){
    for($i = 0; $i < count($dados[$cidade_atual]); $i++){
        if($dados[$cidade_atual][$i]['DESTINO'] == $cidade_destino){
            $dados[$cidade_atual][$i]['KM'] = $cidade_km;
        }else{
            $dados[$cidade_atual][] = ['CIDADE' => $cidade_atual, 'DESTINO' => $cidade_destino, 'KM' => $cidade_km];
        }
    }
}else{
    $dados[$cidade_atual][] = ['CIDADE' => $cidade_atual, 'DESTINO' => $cidade_destino, 'KM' => $cidade_km];
}

if(file_put_contents($path,json_encode($dados))){
    $mensagem = 'Cidades Vinculadas / Editadas com Sucesso!';
}else{
    $mensagem = 'Erro ao Vincular / Editar Cidades!';
}
echo $mensagem;