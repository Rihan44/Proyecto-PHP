<?php 
    $page_title = 'Tienda';
    require_once '../connection.php';
    require 'head.php';
    session_start();

    $sql = "SELECT * FROM songs";

    $result = $conexion->query($sql);
    $canciones = $result->fetch_all(MYSQLI_ASSOC);

    $user_id = $_SESSION['user_id'];

    /* TODO SI YA TENGO LA CANCIÓN EN MI LISTA QUE NO SE MUESTRE AQUI 
    O EN EL CARRITO
    */
?>

<head>
    
</head>
<body>
   <?php 
    require 'header.php';
   ?>
   <main class="tienda">
        <h2>Canciones Disponibles</h2>
        <p>Icono carro con enlace al carro</p>
   <?php       
            foreach ($canciones as $cancion) {
                ?>
                    <div>
                        <h2><?= $cancion['title']; ?></h2>
                        <p><?= $cancion['artist']; ?></p>
                        <p><?= $cancion['price']; ?></p>
                        <form class="form_añadir" action="add.php" method="POST">
                            <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                            <input type="hidden" name="song_id" value="<?php echo $cancion['song_id'] ?>">
                            <button>Añadir</button>
                        </form>
                        <form class="form_eliminar" action="eliminar.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $cancion['song_id'] ?>">
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