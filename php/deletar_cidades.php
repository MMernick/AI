<?php
include '../config_path.php';

$cidade = $_GET['cidade'];

$str_data   = file_get_contents($GLOBALS['PATH'].'/registros/cidades.json');
$data       = json_decode($str_data,true);

$i = 0;
foreach($data AS $elemento) {
   if($cidade == $elemento->CIDADES){
        unset($data[$i]);
        $mensagem = ['ERRO' => '0'];
   }else {
        $mensagem = ['ERRO' => '1'];
   }
   $i++;
}
echo json_encode($mensagem);
