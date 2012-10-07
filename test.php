<?php

    require 'functions.php';

    $file = "config/config.ini";
    $config_array = parse_ini_file($file);
    print_r($config_array);
    
//    $config_array['ghproject'] = 'ghrello2';
//    write_ini_file($config_array)
    
//    $config_array['ghproject'] = 'ghrello2';
    
?>
