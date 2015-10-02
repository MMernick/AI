<?php
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
              <th>KM</th>
            </tr>
        </thead>
        <tbody>';
for($j = 0; $j < count($cidades); $j++){
    if(array_key_exists($cidades[$j], $vinculos)){
    for($i = 0; $i < count($vinculos[$cidades[$j]]); $i++){
            echo '<tr>'.
                    '<td>'.$vinculos[$cidades[$j]][$i]['CIDADE'].'</td>'.
                    '<td>'.$vinculos[$cidades[$j]][$i]['DESTINO'].'</td>'.
                    '<td>'.$vinculos[$cidades[$j]][$i]['KM'].' KM</td>'.
                 '</tr>';
        }
    }
}
echo '</tbody></table>';
