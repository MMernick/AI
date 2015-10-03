<?php
$GLOBALS['PATH']        = str_replace('\\', '/', realpath(__DIR__));

function d($array){
    echo '<br /><pre class="printr">';
    print_r($array);
    echo '</pre>';
  }

