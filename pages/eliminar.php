<?php 
    require_once '../connection.php';
    session_start();

     if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['carrito'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM user_cart WHERE song_id='$id'";
        $result = $conexion->query($sql);

        if($result) {
            $_SESSION['eliminado_carrito'] = true;
        }
        
        header('Location:carrito.php');
    } else if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancion'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM user_songs WHERE song_id='$id'";
        $result = $conexion->query($sql);

        if($result) {
            $_SESSION['eliminado_canciones'] = true;
        }
        
        header('Location:home.php');
    }
?>