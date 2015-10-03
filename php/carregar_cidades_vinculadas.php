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

$vinculos_data  = file_get_contents($GLOBALS['PATH'].'/registros/vincular_cidades.json');
$vinculos       = json_decode($vinculos_data,true);

$cidades_data = file_get_contents($GLOBALS['PATH'].'/registros/cidades.json');
$cidades = json_decode($cidades_data,true);

echo '<table class="table table-hover">'
        .'<thead>
            <tr>
              <th>ATUAL</th>
              <th>DESTINO</th>
              <th>KM (Editar ?)</th>
            </tr>
        </thead>
        <tbody>';
for($j = 0; $j < count($cidades); $j++){
    if(array_key_exists($cidades[$j], $vinculos)){
        for($i = 0; $i < count($vinculos[$cidades[$j]]); $i++){
            echo '<tr cidade='.$vinculos[$cidades[$j]][$i]['CIDADE'].' destino='.$vinculos[$cidades[$j]][$i]['DESTINO'].'>'.
                    '<td>'.$vinculos[$cidades[$j]][$i]['CIDADE'].'</td>'.
                    '<td>'.$vinculos[$cidades[$j]][$i]['DESTINO'].'</td>'.
                    '<td onblur="edita_km(this)" contenteditable="true">'.$vinculos[$cidades[$j]][$i]['KM'].'</td>'.
                 '</tr>';
        }
    }
}
echo '</tbody></table>';
