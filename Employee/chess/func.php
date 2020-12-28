<?php
function debug($ar){
    echo "<pre>";
    if(is_array($ar)){
        print_r($ar);
    } else {
        echo $ar;
    }
    echo "</pre>";
}
function debug2($item){
    echo '<pre>';
    print_r($item);
    echo '</pre>';
}
?>
