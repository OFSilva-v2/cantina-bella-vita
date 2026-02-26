<?php
// Configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Altere para seu usuário do MySQL
define('DB_PASS', ''); // Altere para sua senha do MySQL
define('DB_NAME', 'cantina_bella_vita'); // Nome correto do banco (com underline)

// Criar conexão
function getConnection() {
    try {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        // Verificar conexão
        if ($conn->connect_error) {
            throw new Exception("Falha na conexão: " . $conn->connect_error);
        }
        
        // Configurar charset
        $conn->set_charset("utf8mb4");
        
        return $conn;
    } catch (Exception $e) {
        // Log do erro
        error_log("Erro de conexão: " . $e->getMessage());
        
        // Em produção, mostrar mensagem amigável
        if ($_SERVER['SERVER_NAME'] === 'localhost') {
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        } else {
            die("Desculpe, estamos enfrentando problemas técnicos. Tente novamente mais tarde.");
        }
    }
}

// Função para escapar dados
function escape($conn, $data) {
    return $conn->real_escape_string(trim($data));
}

// Função para fechar conexão
function closeConnection($conn) {
    if ($conn) {
        $conn->close();
    }
}
?>