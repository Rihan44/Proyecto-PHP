<?php
    $page_title = 'Registro';
    require 'pages/head.php';
    require 'connection.php';
?>

<body>
    <main class="login">
        <div class="login__container">
            <h2>Registrate</h2>
            <div class="form__container">
                <form class="form__iniciar" method="POST">
                    <input type="text" name="user" placeholder="User..." />
                    <input type="password" name="password" placeholder="Password..." />
                    <div class="buttons">
                        <button type="submit">Registrarse</button>
                        <a href="/login.php">Ya tengo cuenta</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
<?php


if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['user'];
    $pass_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (name, password) VALUES (?, ?)";
    $stmt = $conexion->prepare($sql);

    $stmt->bind_param("ss", $name, $pass_hashed);
    $stmt->execute();


    $stmt->close();
    $conexion->close();

    header('Location:login.php');
?>
    <META HTTP-EQUIV="refresh" CONTENT="2">
<?php
}

?>