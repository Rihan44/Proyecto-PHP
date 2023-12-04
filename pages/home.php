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
    <main class="mis_canciones main">
        <h2 class="h2">Mis canciones</h2>
        <?php
        foreach ($all_songs as $cancion) {
        ?>
            <div class="canciones__container">
                <h2><?= $cancion['title']; ?></h2>
                <p><?= $cancion['artist']; ?></p>
                <p><?= $cancion['price']; ?></p>
                <form class="form_eliminar" action="eliminar.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $cancion['song_id'] ?>">
                    <input type="hidden" name="cancion">
                    <button>Eliminar</button>
                </form>
            </div>
        <?php
        }
        ?>
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