<?php
    $page_title = 'Login';
    require 'pages/head.php';
    require 'connection.php';
    session_start();
?>

    <body>
        <main class="login">
            <div class="login__container">
                <h2>Logeate</h2>
                <div class="form__container">
                    <form class="form__iniciar" method="POST">
                        <input type="text" name="user" placeholder="User..." />
                        <input type="password" name="password" placeholder="Password..." />
                        <div class="buttons">
                            <button type="submit">Login</button>
                            <a href="/registro.php">No tengo cuenta</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    </body>

    </html>
<?php

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $name = $_POST['user'];

        $pass_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "SELECT * FROM usuarios WHERE name = ?";
        $stmt = $conexion->prepare($sql);

        $stmt->bind_param("s", $name);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        $comprueba_pass = password_verify($_POST['password'], $row['password']);

        if ($comprueba_pass && $name == $row['name']) {
            session_start();

            $_SESSION['user_logeado'] = $row['name'];
            $_SESSION['user_id'] = $row['id'];

            header('Location:index.php');
            ?>
                <META HTTP-EQUIV="refresh" CONTENT="2">
            <?php

        } else if($name != $row['name']) {
            ?> 
                <script>
                    Toastify({
                        text: "El nombre no coincide",
                        duration: 2000,
                        newWindow: true,
                        close: true,
                        gravity: "top", 
                        position: "center", 
                        stopOnFocus: true, 
                        style: {
                            background: "red",
                            color: "#fff"
                        }
                    }).showToast();
                </script>
            <?php
        } else {
            ?> 
                <script>
                    Toastify({
                        text: "La contraseña es incorrecta",
                        duration: 2000,
                        newWindow: true,
                        close: true,
                        gravity: "top", 
                        position: "center", 
                        stopOnFocus: true, 
                        style: {
                            background: "red",
                            color: "#fff"
                        }
                    }).showToast();
                </script>
            <?php
        }

        $stmt->close();
    }

?>