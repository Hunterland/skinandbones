<?php
include_once("../../connection/connection.php");

// require_once("../global/service/verification.php");
// verification('../pages/page-login.php');

if (!empty($_GET['user_id'])) {

    $user_id = $_GET['user_id'];
    $sql_select = "SELECT u.user_id,u.user_name,u.user_email,tp.profile_name ,u.createAt,u.updateAt FROM `tb_user` u INNER JOIN tb_profile tp ON u.profile_id = tp.profile_id WHERE u.user_id = $user_id";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {

        $user_data = mysqli_fetch_assoc($result);

        $name = $user_data['user_name'];
        $email = $user_data['user_email'];
        $profile = $user_data['profile_name'];

        // echo $profile;
    } else {
        header('Location: index.php');
    }
}

if (array_key_exists('exit', $_POST)) {
    endSession('../pages/page-login.php');
}


$sql_profile = "SELECT profile_name FROM tb_profile";
$result_profile = $conn->query($sql_profile);




?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../common/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../common/css/style.css">
    <link rel="stylesheet" href="css/edit_user.css">
    <link rel="icon" href="data:,">

    <title>Usuário</title>

    <script>
        function changeAction() {
            let myform = document.getElementById("myform")
            myform.action = "service/user_update.php"
        }
    </script>


</head>

<body>

    <div class="container">

        <div class="logo-edit">
            <img class="banner-thunnar" src="../../common/favicon/logo_skull.png" alt="">
            <span>SKIN <font color="#C21E6F">AND </font>BONES</span>
        </div>


        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="navbar-brand " href="../../../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand " href="index.php">User</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- <form method="POST" class="form-exit">
            <input type="submit" name="exit" class="btn btn-outline-danger" value="Sair">
        </form> -->

        <div class="manager-user">
            <h1>Cadastro e edição de usuários!</h1>
        </div>

        <form method="post" action="service/process.php" class="m-5" id="myform" autocomplete="off">
            <div class="card-form">

                <div class="inputs">

                    <label for="">Nome</label>
                    <input class="form-control form-control-lg" type="text" name="name" placeholder="Digite o nome completo" value="<?php echo $name ?>" autocomplete="off">

                </div>

                <div class="inputs">

                    <label for="">Email</label>
                    <input class="form-control form-control-lg" type="email" name="email" placeholder="Digite o seu e-mail" value="<?php echo $email ?>" autocomplete="off">

                </div>

                <div class="inputs">

                    <label for="">Perfil</label>
                    <select class="form-select form-select-lg mb-3" name="profile">
                        <?php

                        while ($res_ptofile = mysqli_fetch_assoc($result_profile)) {

                            if ($res_ptofile['profile_name'] == $profile) {

                                echo "<option selected='selected'> " . $res_ptofile['profile_name'] . "</option>";
                            } else {

                                echo "<option > " . $res_ptofile['profile_name'] . "</option>";
                            }
                        }

                        ?>
                    </select>

                </div>

                <div class="inputs">

                    <label for="">Senha</label>
                    <input class="form-control form-control-lg" type="password" name="password" placeholder="Digite a senha" autocomplete="off">

                </div>

                <input class="btn btn-primary" type="submit" value="Cadastrar" <?php if (isset($result)) { ?> <?php if ($result->num_rows > 0) { ?> disabled="disable" <?php } ?> <?php } ?>>

                <input type="hidden" name="id" value="<?php echo $user_id ?>">

                <input onclick="changeAction()" class="btn btn-primary" type="submit" value="Atualizar" name="update" <?php if ($result->num_rows == 0) { ?> disabled="disable" <?php } ?>>

                <a href="index.php" class="btn btn-secondary">Voltar</a>
            </div>


        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>

</html>