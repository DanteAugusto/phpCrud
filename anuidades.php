<?php
    include("config.php")
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg bg-info-subtle">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <?php
                    $sql = "SELECT nome FROM associado WHERE id=".$_GET['id'];
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result)>0){
                        echo "Anuidades de ".$result->fetch_assoc()["nome"];
                    }else{
                        echo "Quem é você?";
                    }
                    if (isset($_GET['quita']) && isset($_GET['anuidade_id'])){
                        $sql = "UPDATE associado_anuidade SET quitado = 1 WHERE associado_id = ".$_GET['id']." AND anuidade_id = ".$_GET['anuidade_id'];
                        $result = mysqli_query($conn, $sql);
                    }
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul> -->
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
            </div>
        </div>
    </nav>
    <?php

        $sql = "SELECT * FROM associado_anuidade where associado_id = ".$_GET['id'];;
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            echo "<table class=\"table\">
                    <thead>
                        <tr>
                        <th scope=\"col\">Ano</th>
                        <th scope=\"col\">Valor</th>
                        <th scope=\"col\">
                            Situação
                        </th>
                        <th scope=\"col\">Alterar Valor</th>
                        </tr>
                    </thead>
                    <tbody>";
            while($row = mysqli_fetch_assoc($result)){
                $sql = "SELECT * FROM anuidade where id = ".$row["anuidade_id"];
                $anuidade = mysqli_query($conn, $sql);
                $anuidade = $anuidade->fetch_assoc();
                // <td>31/02/1438</td> 
                // <td>R$1000</td>
                // <td>Quitada</td> 
                // <td><a href="anuidade.php" class="btn btn-outline-success">Altere</a></td>
                echo "<tr>";
                echo "<td>".$anuidade["ano"]."</td>";
                echo "<td>".$anuidade["valor"]."</td>";
                echo "<td>";
                if($row["quitado"]){
                    echo "Quitada";
                }else{
                    echo "<a href=\"anuidades.php?id=".$_GET["id"]."&quita=1&anuidade_id=".$anuidade["id"]."\" class=\"btn btn-outline-danger\">Dívida (Aperte para quitar)</a>";
                }
                echo"</td>";
                echo "<td><a href=\"anuidade.php?id=".$anuidade["id"]."\" class=\"btn btn-outline-success\">Altere</a></td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        }
    ?>
    <a href="cadastrarAnuidade.php">
        <button type="button" class="btn btn-info" style="margin-left: 2px;">Cadastre Anuidade</button>
    </a>
  </body>
</html>
<?php
    $conn->close();
?>