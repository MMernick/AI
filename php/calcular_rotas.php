<?php
include '../config_path.php';

$cid_atual          = $_GET['cidade_atual'];
$cid_destino        = $_GET['cidade_destino'];
$rota = array();

$vinculos_data      = file_get_contents($GLOBALS['PATH'] . '/registros/vincular_cidades.json');
$vinculos           = json_decode($vinculos_data, true);

$vinculos_data_inv  = file_get_contents($GLOBALS['PATH'] . '/registros/vincular_cidades_inverso.json');
$vinculos_inv       = json_decode($vinculos_data_inv, true);

$vinculos_merge = array_merge_recursive($vinculos,$vinculos_inv);

calcula_rota($cid_atual, $cid_atual, $cid_destino, $vinculos_merge, 0, 0, $rota);

function calcula_rota($cid_inicial, $cid_atual, $cid_destino, $vinculos, $km, $km_atual, $rota) {
    
    if (!in_array($cid_atual, $rota)) {
        $rota[] = $cid_atual;
        $km = $km + $km_atual;
        
        if ($cid_atual == $cid_destino) {
            
            foreach ($rota as $rota){
                echo " => <b> $rota </b>";
            }
            echo "<br>Você chegou ao seu destino de $cid_inicial até $cid_atual. Totalizando $km km <br><br>";
            
            return false;
            
        } else {
            
            if (array_key_exists($cid_atual, $vinculos)) {
                for ($i = 0; $i < count($vinculos[$cid_atual]); $i++) {
                    calcula_rota($cid_inicial, $vinculos[$cid_atual][$i]['DESTINO'], $cid_destino, $vinculos, $km, $vinculos[$cid_atual][$i]['KM'], $rota);
                }
            } else {
                echo "Cidade em questao nao possui vinculos : <b>$cid_atual</b> <br>";
            }
            
        }
    }
    
}
