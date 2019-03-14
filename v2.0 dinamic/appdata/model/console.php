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
?>