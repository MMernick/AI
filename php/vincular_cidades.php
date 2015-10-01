<?php
include '../config_path.php';

$cidade_atual    = $_GET['cidade_atual'];
$cidade_destino  = $_GET['cidade_destino'];
$cidade_km       = $_GET['cidade_km'];

//$existe         = FALSE;
$path           = $GLOBALS['PATH'].'/registros/vincular_cidades.json';

$arquivo = file_get_contents($path);
$dados = json_decode($arquivo, true);

/*for($i = 0; $i < count($dados); $i++){
    if($dados[$i]['CIDADES'] == $nome_cidade){
        $existe = TRUE;
    }
}

if($existe == FALSE){*/
    $dados[] = ARRAY('CIDADE' => $cidade_atual, 'DESTINO' => $cidade_destino, 'KM' => $cidade_km);
    
    $grava = file_put_contents($path,json_encode($dados));

    if($grava == TRUE){
        $mensagem = ['ERRO' => '0'];
    }else{
        $mensagem = ['ERRO' => '1'];
    }
    unset($dados);
/*}else{
    $mensagem = ['ERRO' => '2'];
}*/
echo json_encode($mensagem);