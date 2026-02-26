<?php
require_once 'includes/header.php';
require_once 'banco/conexao.php';

// Buscar produtos em destaque
$conn = getConnection();
$sql = "SELECT p.*, c.nome as categoria_nome 
        FROM produtos p 
        JOIN categorias c ON p.categoria_id = c.id 
        WHERE p.destaque = TRUE 
        LIMIT 4";
$result = $conn->query($sql);
$destaques = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $destaques[] = $row;
    }
}
closeConnection($conn);
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h2>Bem-vindo à Cantina Bella Vita</h2>
        <p>Autêntica comida italiana feita com tradição.</p>
        <a href="produtos.php" class="btn">Ver Cardápio</a>
    </div>
</section>

<!-- Destaques do Cardápio -->
<section class="secao">
    <div class="container">
        <h2>Destaques do Cardápio</h2>
        
        <div class="grid-cards">
            <!-- Pizza -->
            <div class="card">
                <img src="imagens/pratos/pizza.jpeg" alt="Pizza artesanal" class="card-img">
                <div class="card-conteudo">
                    <h3>Pizzas artesanais</h3>
                    <p>As pizzas são preparadas com massa de fermentação lenta, que garante leveza e textura crocante nas bordas. A massa é aberta manualmente e recebe molho de tomate fresco temperado com ervas italianas.</p>
                    <p>Entre os carros-chefe está a <strong>pizza tradicional</strong> e a <strong>pizza calabresa</strong>, coberta com fatias selecionadas de calabresa, cebola e queijo derretido.</p>
                    <p>Depois de montadas, as pizzas são levadas ao forno quente, onde assam rapidamente, preservando sabor e aroma intensos.</p>
                </div>
            </div>
            
            <!-- Massas -->
            <div class="card">
                <img src="imagens/pratos/lasanha.jpeg" alt="Massas frescas" class="card-img">
                <div class="card-conteudo">
                    <h3>Massas frescas da casa</h3>
                    <p>As massas são produzidas com farinha selecionada e ovos frescos, resultando em textura macia e sabor autêntico.</p>
                    <p>A <strong>lasanha</strong> é montada em camadas de massa, molho encorpado e queijo gratinado. O <strong>spaghetti</strong> é preparado al dente e finalizado com molho feito lentamente, realçando os ingredientes.</p>
                    <p>Já o <strong>ravioli</strong> recebe recheios cuidadosamente temperados, enquanto o fettuccine é servido com molhos cremosos que envolvem cada fita de massa de forma equilibrada.</p>
                </div>
            </div>
            
            <!-- Entrada -->
            <div class="card">
                <img src="imagens/pratos/bruschetta.jpeg" alt="Bruschetta" class="card-img">
                <div class="card-conteudo">
                    <h3>Entrada clássica italiana</h3>
                    <p>A <strong>bruschetta</strong> é preparada com pão italiano levemente tostado, azeite de oliva de qualidade, tomates frescos picados e manjericão. Essa entrada abre o apetite e antecipa os sabores marcantes do cardápio.</p>
                </div>
            </div>
            
            <!-- Sobremesa -->
            <div class="card">
                <img src="imagens/pratos/tiramisu.jpeg" alt="Tiramisu" class="card-img">
                <div class="card-conteudo">
                    <h3>Sobremesa especial</h3>
                    <p>Para finalizar a experiência, o <strong>tiramisu</strong> é preparado com camadas delicadas de biscoito embebido em café, creme de mascarpone e toque de cacau.</p>
                    <p>O resultado é uma sobremesa equilibrada, suave e aromática.</p>
                </div>
            </div>
        </div>
        
        <p style="text-align: center; margin-top: 3rem; font-size: 1.2rem; font-style: italic; color: var(--verde-italiano);">
            Assim, na Cantina Bella Vita, cada prato é preparado com dedicação, mantendo viva a essência da culinária italiana e oferecendo aos clientes uma experiência gastronômica acolhedora e memorável.
        </p>
        
        <div style="text-align: center; margin-top: 2rem;">
            <a href="produtos.php" class="btn">Ver Cardápio</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>