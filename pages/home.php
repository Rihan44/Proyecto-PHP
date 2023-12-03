<?php
    $page_title = 'Home';
    require_once '../connection.php';
    require 'head.php';
    session_start();

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM user_songs WHERE user_id = " . $user_id;

    $result = $conexion->query($sql);
    $canciones = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($canciones as $cancion) {

        $sql = "SELECT * FROM songs WHERE song_id = " . $cancion['song_id'];

        $result = $conexion->query($sql);
        $all_songs = $result->fetch_all(MYSQLI_ASSOC);
    }
?>

<body>
    <?php
    require 'header.php';
    ?>
    <main class="mis_canciones">
        <?php
        foreach ($all_songs as $cancion) {
        ?>
            <div>
                <h2><?= $cancion['title']; ?></h2>
                <p><?= $cancion['artist']; ?></p>
                <p><?= $cancion['price']; ?></p>
                <form class="form_eliminar" action="eliminar.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $cancion['song_id'] ?>">
                    <button>Eliminar</button>
                </form>
            </div>
        <?php
        }
        ?>
    </main>

</body>

</html>