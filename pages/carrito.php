<?php 
    $page_title = 'Tienda';
    require_once '../connection.php';
    require 'head.php';
    session_start();

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT s.*
        FROM songs s
        INNER JOIN user_cart uc ON s.song_id = uc.song_id AND uc.user_id = $user_id";

    $result = $conexion->query($sql);
    $canciones = $result->fetch_all(MYSQLI_ASSOC);

?>

<body>
   <?php 
    require 'header.php';
   ?>
   <main class="carrito">
        <h2>Carrito</h2>
   <?php       
            foreach ($canciones as $cancion) {
                ?>
                    <div>
                        <h2><?= $cancion['title']; ?></h2>
                        <p><?= $cancion['artist']; ?></p>
                        <p><?= $cancion['price']; ?></p>
                        <form class="form_eliminar" action="eliminar.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $cancion['song_id'] ?>">
                            <input type="hidden" name="carrito">
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
    if(isset($_SESSION['eliminado_carrito'])){
        ?> 
            <script>
                Toastify({
                    text: "Eliminado del carrito!",
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

        unset($_SESSION['eliminado_carrito']);
    } 
?>