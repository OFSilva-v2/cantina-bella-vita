<?php 
require_once("includes/header.php");
require_once("banco/conexao.php");

// Obter conexão
$conn = getConnection();

// Buscar serviços
$sql = "SELECT * FROM servicos ORDER BY nome";
$result = $conn->query($sql);
?>

<section class="secao">
    <div class="container">
        <h2>Nossos Serviços</h2>
        
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="grid-cards" style="grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));">
                <?php while($servico = $result->fetch_assoc()): ?>
                    <div class="card" style="text-align: center;">
                        <div class="card-conteudo">
                            <?php if (!empty($servico['icone'])): ?>
                                <i class="fas <?php echo $servico['icone']; ?>" style="font-size: 3rem; color: var(--vermelho-italiano); margin-bottom: 1rem;"></i>
                            <?php endif; ?>
                            <h3><?php echo $servico['nome']; ?></h3>
                            <p><?php echo $servico['descricao']; ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 3rem; background: var(--branco); border-radius: 10px;">
                <p>Nenhum serviço cadastrado no momento.</p>
            </div>
        <?php endif; ?>
        
        <!-- Informações adicionais -->
        <div style="margin-top: 4rem; text-align: center;">
            <h3 style="color: var(--verde-italiano); margin-bottom: 2rem;">Horário de Funcionamento</h3>
            <div style="display: inline-block; text-align: left; background: var(--branco); padding: 2rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                <p><strong>Segunda a Quinta:</strong> 18h às 23h</p>
                <p><strong>Sexta e Sábado:</strong> 18h à 00h</p>
                <p><strong>Domingo:</strong> 18h às 22h</p>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 3rem;">
            <p style="font-size: 1.2rem; margin-bottom: 1.5rem;">Para mais informações ou reservas:</p>
            <a href="contato.php" class="btn">Entre em Contato</a>
        </div>
    </div>
</section>

<?php 
closeConnection($conn);
require_once("includes/footer.php"); 
?>