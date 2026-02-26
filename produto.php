<?php
require_once 'includes/header.php';
require_once 'banco/conexao.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $conn = getConnection();
    $sql = "SELECT p.*, c.nome as categoria_nome 
            FROM produtos p 
            JOIN categorias c ON p.categoria_id = c.id 
            WHERE p.id = $id";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $produto = $result->fetch_assoc();
        ?>
        
        <section class="secao">
            <div class="container">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
                    <div>
                        <img src="imagens/pratos/<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>" style="width: 100%; border-radius: 10px;">
                    </div>
                    <div>
                        <h2 style="color: var(--verde-italiano);"><?php echo $produto['nome']; ?></h2>
                        <p style="color: var(--vermelho-italiano); font-size: 1.5rem; margin: 1rem 0;">
                            R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?>
                        </p>
                        <p style="font-size: 1.1rem; line-height: 1.8;"><?php echo $produto['descricao_completa']; ?></p>
                        <p style="margin-top: 1rem;"><strong>Categoria:</strong> <?php echo $produto['categoria_nome']; ?></p>
                        <a href="produtos.php" class="btn" style="margin-top: 2rem;">← Voltar ao Cardápio</a>
                    </div>
                </div>
            </div>
        </section>
        
        <?php
    } else {
        echo "<section class='secao'><div class='container'><p>Produto não encontrado.</p></div></section>";
    }
    closeConnection($conn);
} else {
    header('Location: produtos.php');
    exit;
}

require_once 'includes/footer.php';
?>
