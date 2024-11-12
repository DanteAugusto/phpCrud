<?php
    // Inclui o arquivo de configuração e funções
    require_once '../config.php'; // Contém as configurações de conexão com o banco de dados
    // require_once 'funcoes_banco.php'; // Contém a função adicionarAssociado
    // Função para adicionar um associado e relacioná-lo à anuidade mais recente
    function adicionarAssociado($conn, $nome, $email, $cpf, $dataFiliacao) {
        // Insere o novo associado
        $sql = "INSERT INTO Associado (nome, email, cpf, data_filiacao) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $cpf, $dataFiliacao);
        $stmt->execute();

        // Obtém o ID do associado recém-criado
        $associadoId = $stmt->insert_id;
        $stmt->close();

        // Encontra a anuidade mais recente
        $sqlAnuidade = "SELECT id FROM Anuidade ORDER BY ano DESC LIMIT 1";
        $result = $conn->query($sqlAnuidade);
        $anuidadeId = $result->fetch_assoc()['id'];
        $result->close();

        if ($anuidadeId) {
            // Relaciona o associado à anuidade mais recente e define 'quitado' como o padrão (FALSO)
            $sqlRelacionamento = "INSERT INTO Associado_Anuidade (associado_id, anuidade_id, quitado) VALUES (?, ?, FALSE)";
            $stmtRelacionamento = $conn->prepare($sqlRelacionamento);
            $stmtRelacionamento->bind_param("ii", $associadoId, $anuidadeId);
            $stmtRelacionamento->execute();
            $stmtRelacionamento->close();

            //echo "Associado '$nome' cadastrado e relacionado à anuidade mais recente!<br>";
        } else {
            //echo "Associado '$nome' cadastrado, mas nenhuma anuidade está disponível para relacionamento.<br>";
        }
    }

    // Verifica se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $date = $_POST['date'];

        // Verifica se os campos não estão vazios
        if (!empty($nome) && !empty($email) && !empty($cpf) && !empty($date)) {
            // Chama a função para adicionar o associado
            adicionarAssociado($conn, $nome, $email, $cpf, $date);
            header("Location: ../index.php");
        } else {
            // echo "Todos os campos são obrigatórios!";
        }
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
?>
