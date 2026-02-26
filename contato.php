<?php
require_once 'includes/header.php';
require_once 'banco/conexao.php';

$mensagem_envio = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';
    
    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        $conn = getConnection();
        $nome = escape($conn, $nome);
        $email = escape($conn, $email);
        $telefone = escape($conn, $telefone);
        $mensagem = escape($conn, $mensagem);
        
        $sql = "INSERT INTO contato_mensagens (nome, email, telefone, mensagem) 
                VALUES ('$nome', '$email', '$telefone', '$mensagem')";
        
        if ($conn->query($sql)) {
            $mensagem_envio = '<div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 2rem;">Mensagem enviada com sucesso! Entraremos em contato em breve.</div>';
        } else {
            $mensagem_envio = '<div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px; margin-bottom: 2rem;">Erro ao enviar mensagem. Tente novamente.</div>';
        }
        closeConnection($conn);
    } else {
        $mensagem_envio = '<div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 5px; margin-bottom: 2rem;">Por favor, preencha todos os campos obrigatórios.</div>';
    }
}
?>

<section class="secao">
    <div class="container">
        <h2>Entre em Contato</h2>
        
        <?php echo $mensagem_envio; ?>
        
        <div class="contato-grid">
            <div class="contato-info">
                <h3>Informações de Contato</h3>
                
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Endereço:</strong><br>
                        Rua das Massas, 123<br>
                        Centro<br>
                        Porto Alegre - RS
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email:</strong><br>
                        contato@cantinabellavita.com
                    </div>
                </div>
                
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <strong>Telefone:</strong><br>
                        (51) 99999-9999
                    </div>
                </div>
            </div>
            
            <div class="contato-form">
                <h3>Envie uma Mensagem</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="nome">Nome *</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-mail *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="tel" id="telefone" name="telefone">
                    </div