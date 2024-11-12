<?php
    include("config.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
<body>
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
</body>
<form style="padding-left: 10px; padding-right: 10px" action="actions/cadastrar_associado.php" method="post">
    <div class="mb-3">
        <label for="exampleInputNome" class="form-label">Nome</label>
        <input type="text" class="form-control" name="nome" aria-describedby="anoHelp">
        <!-- <div  class="form-text">Esse valor não pode ser alterado.</div> -->
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Endereço de Email</label>
        <input type="email" class="form-control" name="email"  aria-describedby="emailHelp">
        <!-- <div  class="form-text">We'll never share your email with anyone else.</div> -->
    </div>
    <div class="mb-3">
        <label for="exampleInputNome" class="form-label">CPF</label>
        <input type="text" class="form-control" name="cpf" aria-describedby="anoHelp">
        <!-- <div  class="form-text">Esse valor não pode ser alterado.</div> -->
    </div>
    <div class="mb-3">
        <label for="exampleInputNome" class="form-label">Data de Filiação</label>
        <input type="date" class="form-control" name="date" aria-describedby="anoHelp">
        <!-- <div  class="form-text">Esse valor não pode ser alterado.</div> -->
    </div>
    <button type="submit" class="btn btn-primary">Confirme</button>
</form>
</html>
<?php
    $conn->close();
?>