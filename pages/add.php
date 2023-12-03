<?php 
    require_once '../connection.php';
    session_start();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_id = $_POST['user_id'];
        $song_id = $_POST['song_id'];

        $sql = "INSERT INTO user_cart (user_id, song_id) VALUES (?, ?)";

        $stmt = $conexion->prepare($sql);

        $stmt->bind_param("ii", $user_id, $song_id);
        $stmt->execute();

        if($stmt) {
            $_SESSION['add'] = true;
        }

        $stmt->close();

        header('Location:tienda.php');
    }
?>