<header>
    <nav>
        <h2>
            <?php
                $session = $_SESSION['user_logeado'];
                $nombre = $session;
                
                echo $nombre;
            ?>
         </h2>
        <ul>
            <li>
                <a href="/pages/home.php">Mis canciones</a>
            </li>
            <li>
                <a href="/pages/tienda.php">Tienda</a>
            </li>
            <li>
                <a href="/logout.php">
                    Cerrar Sesion
                </a>
            </li>
        </ul>
    </nav>
</header>