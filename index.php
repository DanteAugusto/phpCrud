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
            <a class="navbar-brand" href="#">Associados</a>
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
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
            </div>
        </div>
    </nav>
    <?php
        $sql = "SELECT * FROM associado";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            echo "<table class=\"table\">
                    <thead>
                        <tr>
                        <th scope=\"col\">Nome</th>
                        <th scope=\"col\">E-mail</th>
                        <th scope=\"col\">CPF</th>
                        <th scope=\"col\">Data de filiação</th>
                        <th scope=\"col\">Pagamento</th>    
                        <th scope=\"col\">Anuidades</th> 
                        <th scope=\"col\">Dívida total</th>      
                        </tr>
                    </thead>
                    <tbody>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                        <td>".$row["nome"]."</td>
                        <td>".$row["email"]."</td>
                        <td>".$row["cpf"]."</td>
                        <td>".$row["data_filiacao"]."</td> 
                        <td>";
                        $sql = "SELECT * FROM associado_anuidade WHERE quitado = 0 AND associado_id =".$row["id"];
                        $check = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($check)>0){
                            echo "Em atraso";
                        }else{
                            echo "Em dia";
                        }
                        echo "</td> 
                        <td><a href=\"anuidades.php?id=";
                        echo $row["id"];
                        echo "\" class=\"btn btn-outline-success\">Ver</a></td>
                        <td>";
                        if(mysqli_num_rows($check)>0){
                            $sql = "SELECT SUM(valor) AS divida FROM anuidade WHERE ";
                            while($id = mysqli_fetch_assoc($check)){
                                $sql= $sql."id=".$id["anuidade_id"]." OR ";
                            }
                            $sql= $sql."id=0";
                            $check = mysqli_query($conn, $sql);
                            echo $check->fetch_assoc()["divida"];
                        }else{
                            echo "0";
                        }
                        echo "</td>
                      </tr>";
            }
            echo "</tbody></table>";
        }
    ?>
    <!-- <table class="table">
        <thead>
            <tr>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">CPF</th>
            <th scope="col">Data de filiação</th>
            <th scope="col">Pagamento</th>    
            <th scope="col">Anuidades</th> 
            <th scope="col">Dívida total</th>      
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>Mark</td>
            <td>Otto.mark@gmail.com</td>
            <td>111.222.333-45</td>
            <td>31/02/1438</td> 
            <td>Em dia</td> 
            <td><a href="anuidades.php" class="btn btn-outline-success">Ver</a></td>
            </tr>
            <tr>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>@mdo</td> 
            <td>Em atraso</td> 
            <td><a href="anuidades.php" class="btn btn-outline-success">Ver</a></td>
            </tr>
            <tr>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>@mdo</td> 
            <td>Em dia</td> 
            <td><a href="anuidades.php" class="btn btn-outline-success">Ver</a></td>
            </tr>
        </tbody>
    </table> -->
    <a href="cadastrarAssociado.php">
        <button type="button" class="btn btn-info" style="margin-left: 2px;">Cadastre Associado</button>
    </a>
  </body>
</html>
<?php
    $conn->close();
?>