<?php
/**
 * FACULDADE ANHANGUERA DE BAURU
 * CIÊNCIAS DA COMPUTAÇÃO
 * 
 * INTELIGÊNCIA ARTIFICIAL
 * ALGORITIMO ARAD/BUCHAREST
 * 
 * CRIADO POR:  CRISTOPHER PARRELA
 * EMAIL:       cmparrela@gmail.com
 * DATA:        03/10/2015
 */

include '../config_path.php';

$cid_atual          = $_GET['cidade_atual'];
$cid_destino        = $_GET['cidade_destino'];

$vinculos_data      = file_get_contents($GLOBALS['PATH'] . '/registros/vincular_cidades.json');
$vinculos           = json_decode($vinculos_data, true);

$vinculos_data_inv  = file_get_contents($GLOBALS['PATH'] . '/registros/vincular_cidades_inverso.json');
$vinculos_inv       = json_decode($vinculos_data_inv, true);

$vinculos_merge = array_merge_recursive($vinculos,$vinculos_inv);

calcula_rota($cid_atual, $cid_atual, $cid_destino, $vinculos_merge, 0, 0);

function calcula_rota($cid_inicial, $cid_atual, $cid_destino, $vinculos, $km, $km_atual, $rota = [], $qtd = 0, $i = 0) {
    
    if (!in_array($cid_atual, $rota)) {
        $rota[] = $cid_atual;
        $km = $km + $km_atual;
        
        if ($cid_atual == $cid_destino) {
            
            $qtd = count($rota);
            echo '<pre class="total">';
            foreach ($rota as $rota){
                if ($i == $qtd - 1) {
                    echo "<b>$rota</b> ";
                }else{
                    echo "<b>$rota</b> <span class=\"glyphicon glyphicon-arrow-right\"></span> ";
                }
                $i++;
            }
            echo "<br>Você chegou ao seu destino de $cid_inicial até $cid_atual. Totalizando <t>$km</t> km";
            echo '</pre>';
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
