<?php
    function console_log($var){
        echo('<script>');
        if(is_string($var)){
            echo('console.log("' . $var . '");');
        }else{
            echo('console.log(' . json_encode($var) . ');');
        }
        echo('</script>');
    }

    function cLog($var){
        $myFile = fopen(__DIR__ . '/../log/LogPruebas.txt', "a") or die("Unable to open file");
        $wString = date("Y-m-d H:i:s") . " " . $var."\n";
        fwrite($myFile, $wString);
        fclose($myFile);

    }
?>