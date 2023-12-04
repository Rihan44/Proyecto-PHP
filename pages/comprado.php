<?php 
    require_once '../connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT s.*
        FROM songs s
        INNER JOIN user_cart uc ON s.song_id = uc.song_id AND uc.user_id = $user_id";

    $result = $conexion->query($sql);
    $canciones = $result->fetch_all(MYSQLI_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_carrito'])) {

        $songs = array_column($canciones, 'song_id');

        $insert_sql = "INSERT INTO user_songs (user_id, song_id) VALUES (?, ?)";
        $stmt = $conexion->prepare($insert_sql);

        foreach ($songs as $song_id) {
            $stmt->bind_param("ii", $user_id, $song_id);
            $stmt->execute();
        }

        $borrar_carrito = "DELETE FROM user_cart";
        $result = $conexion->query($borrar_carrito);

        if($result) {
            $_SESSION['carrito_comprado'] = true;
        }
        

        $stmt->close();
        header('Location: carrito.php');

        exit();
    }

?>