<?php
    // Inclui o arquivo de configuração e funções
    require_once '../config.php'; // Contém as configurações de conexão com o banco de dados
    // Função para atualizar uma nova anuidade
    function atualizarAnuidade($conn, $id, $valor) {
        // Insere uma nova anuidade com o ano e valor fornecidos
        $sql = "UPDATE anuidade SET valor = ".$valor." where id = ".$id;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->close();
    }

    // Verifica se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $id = $_POST['id'];
        $valor = $_POST['valor'];

        // Verifica se os campos não estão vazios
        if (!empty($id) && !empty($valor)) {
            // Chama a função para atualizar a anuidade
            atualizarAnuidade($conn, $id, $valor);
            header("Location: ../index.php");
        } else {
            // echo "Todos os campos são obrigatórios!";
        }
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
?>
