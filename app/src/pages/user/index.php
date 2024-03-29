<?php

session_start();
include_once("../../connection/connection.php");
require_once("../../common/service/verification.php");

$page = (isset($_GET['page'])) ? $_GET['page'] : 1;

$all_in_database = "SELECT u.user_id,u.user_name,u.user_email,tp.profile_name ,u.createAt,u.updateAt FROM `tb_user` u INNER JOIN tb_profile tp ON u.profile_id = tp.profile_id;";
$result_all_itens = $conn->query($all_in_database);

$total_itens = mysqli_num_rows($result_all_itens);
$quantity_itens = 10;
$num_pages = ceil($total_itens / $quantity_itens);

$limit = ($quantity_itens * $page) - $quantity_itens;

if (!empty($_GET['search'])) {

    $data = $_GET['search'];
    $sql = "SELECT u.user_id,u.user_name,u.user_email,tp.profile_name ,u.createAt,u.updateAt FROM `tb_user` u INNER JOIN tb_profile tp ON u.profile_id = tp.profile_id WHERE user_id LIKE '%$data%' or user_name LIKE '%$data%' or user_email LIKE '%$data%' ORDER BY user_id DESC LIMIT $limit,$quantity_itens";
} else {

    $sql = "SELECT u.user_id,u.user_name,u.user_email,tp.profile_name ,u.createAt,u.updateAt FROM `tb_user` u INNER JOIN tb_profile tp ON u.profile_id = tp.profile_id ORDER BY user_id DESC LIMIT $limit,$quantity_itens";
}

$result = $conn->query($sql);
$current_total_itens = mysqli_num_rows($result);

if (array_key_exists('exit', $_POST)) {
    endSession('../login/login.php');
}

$current_path = "index.php";




?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../common/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../common/css/style.css">
    <link rel="stylesheet" href="css/index.css">


    <link rel="icon" href="data:,">
    <title>Cadastro de usuários</title>
    <style>
        .box-search {
            position: relative;
            display: flex;
            margin-bottom: 10px;
        }

        .box-search a {
            position: absolute;
            right: 0px;
        }

        .box-search button {
            margin-left: 10px;
        }
    </style>

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


                    </ul>
                </div>
            </div>
        </nav>
        <!-- <form method="POST" class="form-exit">
            <input type="submit" name="exit" class="btn btn-outline-danger" value="Sair">
        </form> -->

        <div class="manager-user">
            <h1>Bem vindo ao Gerenciador de usuários!</h1>
        </div>

        <div class="box-search">
            <input type="search" class="form-control w-25" placeholder="Pesquisar" id="search">
            <button onclick="searchData()" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
            </button>

            <a href="user_edit.php" class="btn btn-primary " style="margin-bottom:10px;">Novo usuário</a>
        </div>




        <table class="table">
            <thead>
                <tr class="thead">
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">Data de cadastro</th>
                    <th scope="col">Data de Atualização</th>
                    <th scope="col">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {

                    // $currentProfile = getProfile($user_data['profile_id']);

                    echo "<tr>";
                    echo "<td>" . $user_data['user_id'] . "</td>";
                    echo "<td>" . $user_data['user_name'] . "</td>";
                    echo "<td>" . $user_data['user_email'] . "</td>";
                    echo "<td>" . $user_data['profile_name'] . "</td>";
                    echo "<td>" . $user_data['createAt'] . "</td>";
                    echo "<td>" . $user_data['updateAt'] . "</td>";
                    echo "<td> 
                        <a class='btn btn-sm btn-primary' href='user_edit.php?user_id=$user_data[user_id]'> 
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                            <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg>
                        </a> 
                    </td>";
                    echo "<tr>";
                }
                ?>
            </tbody>
        </table>


        <?php

        $previous_page = $page - 1;
        $next_page = $page + 1;

        echo "<div class='card_page'>
<div>
    <p>Número da pagina: $page</p>
</div>
<div>
    <p>Quantidade de paginas: $num_pages</p>
</div>

</div>";
        // echo "NumPage: " . $num_pages . "<br>";

        ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <?php
                    if ($previous_page != 0) { ?>
                        <a class="page-link" href="<?php echo $current_path ?>?page=<?php echo 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    <?php } else { ?>
                        <div class="page-link">
                            <span aria-hidden="true">&laquo;</span>
                        </div>
                    <?php } ?>

                </li>
                <?php



                $i = $page;
                $param = $page;

                if ($page + 1 >= $num_pages) {
                    if ($num_pages >= 2) {
                        if ($page > 1 && $page < 3) {
                            // echo "primeira";
                            $i = $page - 1;
                            $param = $page - 1;
                            if ($num_pages > $page) {
                                // echo "segunda";
                                $param = $page;
                            }
                        } else {
                            // echo "terceira";
                            // $i = $page;
                            // $param = $page;
                            if ($num_pages <= $page && $page > 1) {
                                // echo "quarta";
                                $i = $page - 1;
                                $param = $page - 1;
                            } else if ($page < $num_pages) {
                                // echo "quinta";
                                $i = $page - 1;
                            }
                        }
                    } else {
                        // echo "sexta";
                        $i = $page;
                        $param = $page - 1;
                    }
                } else {
                    if ($page > 1) {
                        // echo "setima";
                        $i = $page - 1;
                    } else {
                        // echo "oitava";
                        $i = $page;
                        $param = $page;
                    }
                }


                for ($i; $i <= $param + 1; $i++) { ?>

                    <li class="page-item"><a class="page-link" href="<?php echo $current_path ?>?page=<?php echo $i ?>"><?php echo $i ?></a></li>

                <?php } ?>


                <li class="page-item">
                    <?php
                    if ($next_page != 0) { ?>
                        <a class="page-link" href="<?php echo $current_path ?>?page=<?php echo $num_pages ?>" aria-label="Previous">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    <?php } else { ?>
                        <div class="page-link">
                            <span aria-hidden="true">&raquo;</span>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </nav>

    </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
<script>
    let search = document.getElementById("search")

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") {
            searchData()
        }
    })

    function searchData() {
        window.location = `index.php?search=${search.value}`
    }
</script>


</html>