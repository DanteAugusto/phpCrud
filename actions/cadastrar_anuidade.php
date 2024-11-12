<?php
    // Inclui o arquivo de configuração e funções
    require_once '../config.php'; // Contém as configurações de conexão com o banco de dados
    // require_once 'funcoes_banco.php'; // Contém a função adicionarAssociado
    // Função para adicionar uma nova anuidade
    function adicionarAnuidade($conn, $ano, $valor) {
        // Insere uma nova anuidade com o ano e valor fornecidos
        $sql = "INSERT INTO Anuidade (ano, valor) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("id", $ano, $valor); // "i" para integer (ano) e "d" para double (valor)
        if ($stmt->execute()) {
            //echo "Anuidade para o ano $ano adicionada com sucesso!<br>";
        } else {
            //echo "Erro ao adicionar a anuidade: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    // Verifica se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $ano = $_POST['ano'];
        $valor = $_POST['valor'];

        // Verifica se os campos não estão vazios
        if (!empty($ano) && !empty($valor)) {
            // Chama a função para adicionar o associado
            adicionarAnuidade($conn, $ano, $valor);
            header("Location: ../index.php");
        } else {
            // echo "Todos os campos são obrigatórios!";
        }
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
?>
