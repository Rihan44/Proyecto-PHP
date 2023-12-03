<?php 
    $page_title = 'Musica';
    require 'pages/head.php';
    require 'connection.php';
    session_start();
?>
<body>
    <?php if(isset($_SESSION['user_logeado'])) {
        header('Location:/pages/home.php');
    } else {
        header('Location:login.php');
    }
    ?>   
</body>
</html>