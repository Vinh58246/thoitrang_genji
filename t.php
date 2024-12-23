<?php
$flag_name = 0;
for ($i=0; $i < 19; $i++) { 
    echo $flag_name;


    $flag_name++;
    if($flag_name == 3){
        $flag_name = 0;
    }
}
?>