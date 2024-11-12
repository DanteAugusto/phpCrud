<?php
    // Defina as credenciais do banco de dados
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'tecnotech';

    // Crie a conexão MySQLi
    $conn = new mysqli($host, $username, $password);

    // Verifique a conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // SQL para criar o banco de dados
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === TRUE) {
        // //echo "Banco de dados '$dbname' criado com sucesso!";
    } else {
        // //echo "Erro ao criar o banco de dados: " . $conn->error;
    }
    // Cria a conexão MySQLi
    $conn = new mysqli($host, $username, $password, $dbname);
    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Criação da tabela Associado
    $sqlAssociado = "CREATE TABLE IF NOT EXISTS Associado (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        cpf CHAR(11) NOT NULL UNIQUE,
        data_filiacao DATE NOT NULL
    )";
    if ($conn->query($sqlAssociado) === TRUE) {
        //echo "Tabela 'Associado' criada com sucesso!<br>";
    } else {
        //echo "Erro ao criar a tabela Associado: " . $conn->error . "<br>";
    }

    // Criação da tabela Anuidade
    $sqlAnuidade = "CREATE TABLE IF NOT EXISTS Anuidade (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ano YEAR NOT NULL UNIQUE,
        valor DECIMAL(10, 2) NOT NULL
    )";
    if ($conn->query($sqlAnuidade) === TRUE) {
        //echo "Tabela 'Anuidade' criada com sucesso!<br>";
    } else {
        //echo "Erro ao criar a tabela Anuidade: " . $conn->error . "<br>";
    }

    // Criação da tabela intermediária Associado_Anuidade com coluna 'quitado' do tipo BOOLEAN
    $sqlAssociadoAnuidade = "CREATE TABLE IF NOT EXISTS Associado_Anuidade (
        associado_id INT NOT NULL,
        anuidade_id INT NOT NULL,
        quitado BOOLEAN DEFAULT FALSE, -- Valor padrão é Falso (0)
        PRIMARY KEY (associado_id, anuidade_id),
        FOREIGN KEY (associado_id) REFERENCES Associado(id) ON DELETE CASCADE,
        FOREIGN KEY (anuidade_id) REFERENCES Anuidade(id) ON DELETE CASCADE
    )";
    if ($conn->query($sqlAssociadoAnuidade) === TRUE) {
        //echo "Tabela 'Associado_Anuidade' criada com sucesso!<br>";
    } else {
        //echo "Erro ao criar a tabela Associado_Anuidade: " . $conn->error . "<br>";
    }

    

    // Função para alterar o valor de uma anuidade existente
    function alterarValorAnuidade($conn, $ano, $novoValor) {
        // Atualiza o valor da anuidade para o ano especificado
        $sql = "UPDATE Anuidade SET valor = ? WHERE ano = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("di", $novoValor, $ano); // "d" para double (novoValor) e "i" para integer (ano)
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                //echo "Valor da anuidade para o ano $ano atualizado para $novoValor!<br>";
            } else {
                //echo "Nenhuma anuidade encontrada para o ano $ano.<br>";
            }
        } else {
            //echo "Erro ao atualizar o valor da anuidade: " . $stmt->error . "<br>";
        }
        $stmt->close();
    }

    // // Exemplo de uso da função para adicionar um associado
    // adicionarAnuidade($conn, 2024, 500.00); // Adiciona uma nova anuidade para o ano 2024
    // alterarValorAnuidade($conn, 2024, 550.00); // Atualiza o valor da anuidade de 2024 para 550.00
    // adicionarAssociado($conn, 'João Silva', 'joao@email.com', '12345678901');

?>
