<?php 

    $envFile = __DIR__.'/.env';

    if (file_exists($envFile)) {
        $envVariables = parse_ini_file($envFile);

        foreach ($envVariables as $key => $value) {
            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }

    $server_name = $_ENV['SERVER_NAME'];
    $username = $_ENV['USERNAME'];
    $password = $_ENV['PASSWORD'];
    $database = $_ENV['DATABASE'];

    $conexion = new mysqli($server_name, $username, $password, $database);

?>