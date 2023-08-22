<?php

// if (isset($_GET['isRegistered'])) {
//     $isRegistered = $_GET['isRegistered'];
//     if (!!$isRegistered) {
//         echo "<script> $('.alert').alert() </script>";
//     }
// }



?>

<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skin and Bones - entre ou Cadastre-se</title>

    
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700&display=swap" rel="stylesheet">
    
    
    <!-- FAVICON -->
    <link rel="shortcut icon" href="../../common/favicon/logo_skull.png" type="image/x-icon">
    
    <link rel="stylesheet" href="../../common/js/bootstrap.min.js">
    <link rel="stylesheet" href="../../common/js/jquery-3.6.1.min.js">
    <link rel="stylesheet" href="../../common/css/bootstrap.min.css">
    
    <!-- CSS STYLE -->
    <link rel="stylesheet" href="css/style.css">
    

</head>

<body>



    <div class="main-cadastro">
        <div class="alert hide" id="my-alert">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg">Usuário já Cadastrado!</span>
            <div class="close-btn">
                <span class="fas fa-times">x</span>
            </div>
        </div>

        <!-- PARTE ESQUERDA DA TELA -->
        <div class="left-cadastro">
            <h1>Cadastre-se<br>E entre para o nosso time.</h1>
            <img src="img/gym-animate.svg" class="left-cadastro-image" alt="gym-animate">

        </div>
        <!-- PARTE DIREITA DA TELA -->
        <div class="right-cadastro">

            <!-- FORMULARIO -->
            <div class="card-cadastro">
                <h1>SKIN <font color="#C21E6F">AND</font> BONES <img class="logo" src="../../common/favicon/logo_skull.png" alt="logo_skull"></h1>
                <form action="service/save.php" method="POST">
                    <div class="textfield">

                        <input type="text" name="usuario" placeholder="Usuário">
                    </div>
                    <div class="textfield">

                        <input type="email" name="email" placeholder="Email">
                    </div>
                    <div class="textfield">

                        <input type="password" name="senha" placeholder="Senha">
                    </div>
                    <button type="submit" class="btn-cadastro">Cadastre-se</button>
                </form>
                <p>Já tem uma conta?</p>
                <a class="btn-cadastro" href="../login/login.php">Entrar</a>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

<script>
    function badRegister() {

        console.log("deu bom");
        let alertBadRegister = document.getElementById("my-alert")
        alertBadRegister.classList.remove("hide")
        alertBadRegister.classList.add("show")

        setTimeout(() => {
            alertBadRegister.classList.remove("show")
            alertBadRegister.classList.add("hide")
        },4000)

    }
</script>

<?php


if (isset($_GET['isRegistered'])) {
    $isRegistered = $_GET['isRegistered'];
    if (!!$isRegistered) {
        
        echo "<script> badRegister() </script>";

    }
}



?>

</html>