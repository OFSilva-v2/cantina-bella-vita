// Animação de scroll suave para links internos
document.addEventListener('DOMContentLoaded', function() {
    // Scroll suave para âncoras
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Animação de fade-in ao rolar a página
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Aplicar animação aos cards
    document.querySelectorAll('.card, .produto-card, .info-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Destaque do menu ativo
    const currentPage = window.location.pathname.split('/').pop();
    const menuLinks = document.querySelectorAll('nav ul li a');
    
    menuLinks.forEach(link => {
        const linkPage = link.getAttribute('href');
        if (linkPage === currentPage || 
            (currentPage === '' && linkPage === 'index.php')) {
            link.classList.add('ativo');
        }
    });

    // Efeito hover nos cards
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Validação simples do formulário de contato
    const formContato = document.querySelector('form');
    if (formContato) {
        formContato.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const nome = document.getElementById('nome');
            const email = document.getElementById('email');
            const mensagem = document.getElementById('mensagem');
            
            if (!nome.value || !email.value || !mensagem.value) {
                alert('Por favor, preencha todos os campos obrigatórios.');
                return;
            }
            
            if (!isValidEmail(email.value)) {
                alert('Por favor, insira um e-mail válido.');
                return;
            }
            
            // Simular envio bem-sucedido
            alert('Mensagem enviada com sucesso! Entraremos em contato em breve.');
            this.reset();
        });
    }
});

function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Função para carregar produtos via AJAX
function carregarProdutos(categoria = 'todos') {
    fetch(`api/produtos.php?categoria=${categoria}`)
        .then(response => response.json())
        .then(data => {
            const container = document.querySelector('.produtos-grid');
            if (container) {
                container.innerHTML = '';
                data.forEach(produto => {
                    const card = criarCardProduto(produto);
                    container.appendChild(card);
                });
            }
        })
        .catch(error => console.error('Erro ao carregar produtos:', error));
}

function criarCardProduto(produto) {
    const div = document.createElement('div');
    div.className = 'produto-card';
    div.innerHTML = `
        <img src="imagens/pratos/${produto.imagem}" alt="${produto.nome}" class="produto-img">
        <div class="produto-info">
            <h3>${produto.nome}</h3>
            <p class="produto-preco">R$ ${produto.preco.toFixed(2)}</p>
            <p class="produto-descricao">${produto.descricao_curta}</p>
            <a href="produto.php?id=${produto.id}" class="btn btn-pequeno">Ver detalhes</a>
        </div>
    `;
    return div;
}