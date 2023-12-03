<?php 
    require_once '../connection.php';
    session_start();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $sql = "DELETE FROM songs WHERE song_id='$id'";
        $result = $conexion->query($sql);

        if($result) {
            $_SESSION['eliminado'] = true;
        }

        header('Location:tienda.php');
    }
?>