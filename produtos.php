<?php
require_once 'includes/header.php';
require_once 'banco/conexao.php';

// Buscar categorias
$conn = getConnection();
$categorias_sql = "SELECT * FROM categorias ORDER BY nome";
$categorias_result = $conn->query($categorias_sql);

// Buscar produtos (com filtro de categoria se especificado)
$categoria_filtro = isset($_GET['categoria']) ? (int)$_GET['categoria'] : 0;
$sql = "SELECT p.*, c.nome as categoria_nome 
        FROM produtos p 
        JOIN categorias c ON p.categoria_id = c.id";
        
if ($categoria_filtro > 0) {
    $sql .= " WHERE p.categoria_id = $categoria_filtro";
}
$sql .= " ORDER BY c.nome, p.nome";
$produtos_result = $conn->query($sql);
?>

<section class="secao">
    <div class="container">
        <h2>Nosso Cardápio</h2>
       		
		<!-- Filtros por categoria - Versão com outline -->
<div class="filtros-cardapio">
    <a href="produtos.php" class="btn-filtro-outline <?php echo ($categoria_filtro == 0) ? 'ativo' : ''; ?>">
        Todos
    </a>
    <?php 
    if ($categorias_result && $categorias_result->num_rows > 0) {
        // Voltar ao início do resultado
        $categorias_result->data_seek(0);
        while($categoria = $categorias_result->fetch_assoc()) {
            $classe_ativa = ($categoria_filtro == $categoria['id']) ? 'ativo' : '';
            // Adicionar classe específica baseada no nome da categoria (opcional)
            $classe_categoria = strtolower(str_replace(' ', '-', $categoria['nome']));
            echo "<a href='produtos.php?categoria=" . $categoria['id'] . "' 
                       class='btn-filtro-outline $classe_ativa $classe_categoria'>" 
                       . $categoria['nome'] . "</a>";
        }
    }
    ?>
</div>
        
        <!-- Grid de produtos -->
        <div class="produtos-grid">
            <?php
            if ($produtos_result && $produtos_result->num_rows > 0) {
                while($produto = $produtos_result->fetch_assoc()) {
                    ?>
                    <div class="produto-card">
                        <img src="imagens/pratos/<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>" class="produto-img">
                        <div class="produto-info">
                            <h3><?php echo $produto['nome']; ?></h3>
                            <p class="produto-preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                            <p class="produto-descricao"><?php echo $produto['descricao_curta']; ?></p>
                            <a href="produto.php?id=<?php echo $produto['id']; ?>" class="btn btn-pequeno">Ver detalhes</a>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p style='text-align: center; grid-column: 1/-1;'>Nenhum produto encontrado.</p>";
            }
            closeConnection($conn);
            ?>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
