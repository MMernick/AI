<?php
include '../config_path.php';

$nome_cidade    = $_GET['nome_cidade'];
$existe         = FALSE;
$path           = $GLOBALS['PATH'].'/registros/cidades.json';

$arquivo = file_get_contents($path);
$dados = json_decode($arquivo, true);

for($i = 0; $i < count($dados); $i++){
    if($dados[$i] == $nome_cidade){
        $existe = TRUE;
    }
}

if($existe == FALSE){
    $dados[] = $nome_cidade;

    $grava = file_put_contents($path,json_encode($dados));

    if($grava == TRUE){
        $mensagem = ['ERRO' => '0'];
    }else{
        $mensagem = ['ERRO' => '1'];
    }
    unset($dados);
}else{
    $mensagem = ['ERRO' => '2'];
}
echo json_encode($mensagem);