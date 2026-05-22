<?php
// 1.1 Comentários: Página principal que exibe a listagem de publicações (Leitura/Read)
require_once __DIR__ . '/classes/Publicacao.php';

// 7.4 Instanciação de Objetos
$publicacao = new Publicacao();

// 9.2 Leitura e apresentação de registro
$stmt = $publicacao->lerTodas(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Divulgação - Início</title>
    <link rel="stylesheet" href="assets/style.css"/>

</head>
<body>
    <header>
        <div class="logo"><img src="assets/rainbowdash_logo.png" alt="Rainbow Dash Logo" style="height: 75px; display: block;"></div>
        <nav>
            <a href="index.php">Início</a>
            <a href="cadastrar.php">Cadastrar Novo</a>
        </nav>
    </header>
    <hr>
    <section class="banner">
        <div class="banner-content">
            <h1>Descubra novos livros</h1>
            <p>Avaliações, rankings e recomendações para leitores. Cadastre e divulgue sua publicação!</p>
        </div>
    </section>
    <main class="container">
        <h2 class="section-title">Publicações em destaque</h2>
        <a href="cadastrar.php" class="btn-add">Adicionar Nova Publicação</a>

        <div class="books">
            <?php
            // 6.1 Controle de Fluxo: If_Else
            if($stmt->rowCount() > 0) {
                // 5.3 Laços: While (Poderia ser Do_While ou Foreach se array)
                // 3.3 Operador de Atribuição: $row = ...
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    
                    // Extrai as chaves do array associativo como variáveis
                    extract($row);
                    
                    // 6.3 Operador Ternário: Se imagem for vazia, usa placeholder genérico
                    $imagemExibicao = !empty($imagem) ? $imagem : 'https://via.placeholder.com/150';
                    ?>
                    <div class="card">
                        <img src="<?= $imagemExibicao ?>" alt="Capa da publicação">
                        
                        <div class="card-content">
                            <h3><?= htmlspecialchars($titulo) ?></h3>
                            <div class="rating">⭐ <?= htmlspecialchars($nota) ?></div>

                            <p class="description">
                                <?= htmlspecialchars($descricao) ?>
                                <br><br>
                                <small><strong>Autor:</strong> <?= htmlspecialchars($autor_nome) ?></small><br>
                                <small><strong>Tipo:</strong> <?= htmlspecialchars($tipo_nome) ?></small>
                            </p>
                            <div class="actions">
                                <a href="cadastrar.php?id=<?= $id ?>" class="btn-edit">Editar</a>
                                <a href="processar.php?acao=deletar&id=<?= $id ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir esta publicação?');">Excluir</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Nenhuma publicação encontrada. Seja o primeiro a cadastrar!</p>";
            }
            ?>
        </div>
    </main>
</body>
</html>