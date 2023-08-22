<?php

class Types
{
    public $type_login;

    public function setTypeLogin($i)
    {
        $this->type_login = $i;
    }

    public function getTypeLogin()
    {
        return $this->type_login;
    }
}



// $type_login = null;

$type_login = new Types();
$path = "";



if (!empty($_GET['typeLogin'])) {

    $type_login->setTypeLogin($_GET['typeLogin']);

    if ($type_login->getTypeLogin() == "user") {
        $path = "../../../index.php?admin=true";
    } else {
        $path = "../client/client.php";
    }
}



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

    <!-- CSS STYLE -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/alert.css">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

    <script src="../../common/js/bootstrap.min.js"></script>
    <script src="../../common/js/jquery-3.6.1.min.js"></script>

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../../common/favicon/logo_skull.png" type="image/x-icon">

</head>

<body>
    <div class="main-cadastro">

        <div class="alert hide" id="my-alert">
            <span class="fas fa-exclamation-circle">!</span>
            <span class="msg" id="my-msg">Usuário já Cadastrado!</span>
            <div class="close-btn">
                <span class="fas fa-times">x</span>
            </div>
        </div>

        <!-- PARTE ESQUERDA DA TELA -->
        <div class="left-cadastro">
            <h1>A sua melhor opção na hora de levar uma vida + saudável.</h1>
            <img src="../../common/img/gym-animate.svg" class="left-cadastro-image" alt="gym-animate">



        </div>

        <!-- PARTE DIREITA DA TELA -->
        <div class="right-cadastro">

            <!-- FORMULARIO -->
            <div class="card-cadastro">
                <h1>SKIN <font color="#C21E6F">AND</font> BONES <img class="logo" src="../../common/favicon/logo_skull.png" alt="logo_skull"> </h1>

                <form action="../../common/service/login.php" method="POST">
                    <div class="textfield">

                        <input type="text" name="email" placeholder="Usuário">
                    </div>

                    <div class="textfield">

                        <input type="password" name="password" placeholder="Senha">
                    </div>
                    <!-- <a class="btn-cadastro" type="submit">Entrar</a> -->

                    <input id="type" type="hidden" name="type" value="<?php echo $type_login->getTypeLogin() ?>">

                    <button type="submit" class="btn-cadastro">Entrar</button>
                </form>

                <p>Não tem uma conta?</p>
                <!-- <button class="btn-cadastro"><a href="../login/index.html"><a href="../cadastro/index.html">Inscreva-se</a></a></button> -->
                <a id="register" href="<?php echo $path ?>" class="btn-cadastro">Inscreva-se</a>
            </div>
        </div>
</body>


<script>
    const TypeAlert = {
        Password: 0,
        Client: 1
    }

    function badRegister(type, myValue,path) {


        let alertBadRegister = document.getElementById("my-alert")
        alertBadRegister.classList.remove("hide")
        alertBadRegister.classList.add("show")

        let inputType = document.getElementById("type")
        inputType.value = myValue

        let inputRegister = document.getElementById("register")
        inputRegister.setAttribute("href",path)


        let msg = document.getElementById("my-msg")
        if (type == TypeAlert.Password) {
            msg.innerHTML = "Senha inválida!"
            msg.style.color = "#ce8500"
            alertBadRegister.style.background = "#ffdb9b"
            alertBadRegister.style.borderLeft = "10px solid #ff7502"
        } else {
            msg.innerHTML = "Login não encontrado no sistema!!"
            msg.style.color = "#fdfd08"
            alertBadRegister.style.background = "#B22222"
            alertBadRegister.style.borderLeft = "10px solid #ff7502"
        }



        setTimeout(() => {
            alertBadRegister.classList.remove("show")
            alertBadRegister.classList.add("hide")
        }, 4000)

    }
</script>

<?php


if (isset($_GET['fail_login'])) {
    $isRegistered = $_GET['fail_login'];
    if (!!$isRegistered) {

        echo "<script> badRegister(TypeAlert.Password) </script>";
    }
}

if (isset($_GET['fail_client'])) {
    $isRegistered = $_GET['fail_client'];
    if (!!$isRegistered) {
        $type_login->setTypeLogin("client");
        echo '<script> badRegister(TypeAlert.Client, "client" ,"../client/client.php" ) </script>';
        // var_dump($type_login->getTypeLogin());
    }
}

if (isset($_GET['fail_user'])) {
    $isRegistered = $_GET['fail_user'];
    if (!!$isRegistered) {
        $type_login->setTypeLogin("user");
        echo '<script> badRegister(TypeAlert.Client, "user", "../../../index.php?admin=true" ) </script>';
    }
}




?>

</html>