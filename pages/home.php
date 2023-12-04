<?php
    $page_title = 'Home';
    require_once '../connection.php';
    require 'head.php';
    session_start();

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM user_songs WHERE user_id = " . $user_id;

    $result = $conexion->query($sql);
    $canciones = $result->fetch_all(MYSQLI_ASSOC);

    $all_songs = [];

    foreach ($canciones as $cancion) {
        $mis_canciones = "SELECT * FROM songs WHERE song_id = " . $cancion['song_id'];

        $resultado = $conexion->query($mis_canciones);
        $songs = $resultado->fetch_all(MYSQLI_ASSOC);

        $all_songs = array_merge($all_songs, $songs);
    }

?>

<body>
    <?php
    require 'header.php';
    ?>
    <main class="mis_canciones main">
        <h2 class="h2">Mis canciones</h2>
        <div class="canciones__container">
            <?php
            if(count($all_songs) > 0) {

                foreach ($all_songs as $song) {
                ?>
                    <div class="canciones">
                        <h2><?= $song['artist']; ?></h2>
                        <p><?= $song['title']; ?></p>
                        <div class="button__container">
                            <form class="form_eliminar" action="eliminar.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $song['song_id'] ?>">
                                <input type="hidden" name="cancion">
                                <button class="btn__eliminar">Eliminar</button>
                            </form>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                    <h3 class="no_canciones">No hay canciones aún...</h3>
                <?php
            }
            ?>
        </div>
    </main>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>


<?php 
    if(isset($_SESSION['eliminado_canciones'])){
        ?> 
            <script>
                Toastify({
                    text: "Eliminado de mis canciones!",
                    duration: 2000,
                    newWindow: true,
                    close: true,
                    gravity: "top", 
                    position: "center", 
                    stopOnFocus: true, 
                    style: {
                        background: "#1db954",
                        color: "#fff"
                    }
                }).showToast();
            </script>
        <?php

        unset($_SESSION['eliminado_canciones']);
    } 
?>