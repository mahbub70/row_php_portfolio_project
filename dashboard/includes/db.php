<?php 
    ob_start();
    define('HOSTNAME','localhost');
    define('USERNAME','root');
    define('PASSWORD','');
    define('DATABASE_NAME','probizz');

    $db_connect = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE_NAME);

    if(!$db_connect){
        header("location: /500-server-error");
    }
?>