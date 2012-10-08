<?php

    if(empty($_POST["trtoken"])) {
        die("no valid post parameter");    
    }
    
    echo '<script>alert("action: took token: " + trtoken);</script>';
    $config_array = parse_ini_file("config/config.ini");
    $newconfig['trtoken'] = $_POST["trtoken"];
    write_ini_file($config_array);
?>
