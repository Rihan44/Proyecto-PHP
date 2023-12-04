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

    $total = 0;

    foreach ($canciones as $cancion) {
        $total += $cancion['price'];
    }

?>

<body>
    <?php 
        require 'header.php';
    ?>
    <main class="carrito main">
        <h2 class="h2">Carrito</h2>
        <div class="carrito__container">
            <?php
            if(count($canciones) > 0) {
                foreach ($canciones as $cancion) {
                    ?>
                        <div class="canciones__carrito">
                            <h2><?= $cancion['artist']; ?></h2>
                            <p><?= $cancion['title']; ?></p>
                            <p class="price"><?= $cancion['price']; ?> $</p>
                            <form class="form_eliminar" action="eliminar.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $cancion['song_id'] ?>">
                                <input type="hidden" name="carrito">
                                <button class="btn__eliminar">Eliminar</button>
                            </form>
                        </div>
                    <?php
                }
                ?>
                <p class="total__carrito">Total: <?php echo $total?> $</p>
                <form method="post" action="comprado.php">
                    <input type="hidden" name="agregar_carrito">
                    <button class="btn__compra" type="submit">Comprar</button>
                </form>
                <?php
            } else {
                ?>
                    <h3 class="no_canciones">No hay items..</h3>
                <?php
            }
            ?>
            
        </div>
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
    
    if(isset($_SESSION['carrito_comprado'])){
        ?> 
            <script>
                Toastify({
                    text: "Compra realizada con éxito!",
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
        unset($_SESSION['carrito_comprado']);
    }
?>