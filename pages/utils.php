<?php 
 function conection(){
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

    return $conexion;
 }

 function sendquery($conexion, $query){
    $resultado = mysqli_query($conexion, $query);
    if(!$resultado){
        exit("Error en la query ".mysqli_error($conexion));
    }

    return $resultado;
 }

 function borrar_cancion($id, $conexion) {

    $id = $_POST['id'];

    $query = "DELETE FROM peliculas WHERE id = ?";
    $st = mysqli_prepare($conexion, $query);

    if(!mysqli_stmt_bind_param($st, "i", $id)){
        die("Error en el bind ".mysqli_stmt_error($st));
    }

    if(!mysqli_stmt_execute($st)){
        die("Error en el execute " . mysqli_stmt_error($st));
    }

    mysqli_stmt_close($st);
    header('Location:index.php');

 }

?>