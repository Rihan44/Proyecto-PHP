<?php 
    $page_title = 'Tienda';
    require_once '../connection.php';
    require 'head.php';
    session_start();

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT s.*
        FROM songs s
        WHERE NOT EXISTS (
            SELECT 1
            FROM user_songs us
            WHERE us.song_id = s.song_id AND us.user_id = $user_id
        )
        AND NOT EXISTS (
            SELECT 1
            FROM user_cart uc
            WHERE uc.song_id = s.song_id AND uc.user_id = $user_id
        )";

    $result = $conexion->query($sql);
    $canciones = $result->fetch_all(MYSQLI_ASSOC);

    $carrito_sql = "SELECT * FROM user_cart";

    $result_carrito = $conexion->query($carrito_sql);
    $cosas_carrito = $result_carrito->fetch_all(MYSQLI_ASSOC);

?>

<body>
   <?php 
    require 'header.php';
   ?>
   <main class="tienda main">
        <div class="title__tienda-container">
            <h2 class="h2">Canciones Disponibles</h2>
            <a href="carrito.php">
                <span class="material-symbols-outlined">
                    shopping_cart
                </span>
            </a>
            <div class="items__carrito"><?= count($cosas_carrito)?></div>
        </div>
   <?php       
            ?>
            <div class="canciones__container">
            <?php
                foreach ($canciones as $cancion) {
                    ?>
                        <div class="canciones">
                            <h2><?= $cancion['artist']; ?></h2>
                            <p><?= $cancion['title']; ?></p>
                            <div class="button__container">
                                <p class="canciones__price"><?= $cancion['price']; ?>$</p>
                                <form class="form_añadir" action="add.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                                    <input type="hidden" name="song_id" value="<?php echo $cancion['song_id'] ?>">
                                    <input type="hidden" name="tienda">
                                    <button>Añadir</button>
                                </form>
                            </div>
                        </div>
                    <?php
                }
            ?>
            </div>
            <?php
        ?>
   </main>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>
</html>

<?php 
    if(isset($_SESSION['eliminado'])){
        ?> 
            <script>
                Toastify({
                    text: "Eliminado correctamente!",
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

        unset($_SESSION['eliminado']);
    } else if(isset($_SESSION['add'])){
        ?> 
            <script>
                Toastify({
                    text: "Añadido correctamente!",
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
        unset($_SESSION['add']);
    }
?>