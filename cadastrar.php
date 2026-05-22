<?php
// 1.1 Comentários: Página responsável pelo formulário de Cadastro e Edição
require_once __DIR__ . '/classes/Publicacao.php';

$publicacao = new Publicacao();

// Verifica se está editando ou criando
// 6.1 If_Else e 3.4 Comparação
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $dados = $publicacao->lerUm($id);
    $acao = "atualizar";
    $titulo_pagina = "Editar Publicação";
} else {
    $dados = []; // Novo registro
    $acao = "inserir";
    $titulo_pagina = "Cadastrar Nova Publicação";
}

// 6.3 Operador Ternário para definir os values do input
$titulo = isset($dados['titulo']) ? $dados['titulo'] : "";
$nota = isset($dados['nota']) ? $dados['nota'] : 0.0;
$descricao = isset($dados['descricao']) ? $dados['descricao'] : "";
$imagem = isset($dados['imagem']) ? $dados['imagem'] : "";
$idDivulgacao = isset($dados['idDivulgacao']) ? $dados['idDivulgacao'] : 1;
$idAutores = isset($dados['idAutores']) ? $dados['idAutores'] : 1;
$idTipoPublicacao = isset($dados['idTipoPublicacao']) ? $dados['idTipoPublicacao'] : 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo_pagina ?> - Divulgação</title>
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
    <main class="container">
        <h2 class="section-title"><?= $titulo_pagina ?></h2>
        
        <div class="form-container">
            <form action="processar.php" method="POST">
                <!-- Passando a ação e o id ocultos -->
                <input type="hidden" name="acao" value="<?= $acao ?>">
                <?php if($acao == "atualizar"): ?>
                    <input type="hidden" name="id" value="<?= $id ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="titulo">Título da Publicação</label>
                    <input type="text" id="titulo" name="titulo" value="<?= htmlspecialchars($titulo) ?>" required>
                </div>

                <div class="form-group">
                    <label for="nota">Nota (0 a 10)</label>
                    <select id="nota" name="nota" required>
                        <?php
                        // 5.1 Laços: For (gerando opções de nota de 0 a 10)
                        // 3.5 Operador de Incremento ($i++)
                        for($i = 0; $i <= 10; $i++) {
                            // 3.4 Operador de Comparação (==)
                            $selected = ($nota == $i) ? "selected" : "";
                            echo "<option value='$i' $selected>$i</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="4" required><?= htmlspecialchars($descricao) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="imagem">URL da Imagem (Opcional)</label>
                    <input type="url" id="imagem" name="imagem" value="<?= htmlspecialchars($imagem) ?>" placeholder="Ex: https://link-da-imagem.com/foto.jpg">
                </div>

                <div class="form-group">
                    <label for="idAutores">Autor</label>
                    <select id="idAutores" name="idAutores">
                        <option value="1" <?= $idAutores == 1 ? "selected" : "" ?>>Machado de Assis</option>
                        <option value="2" <?= $idAutores == 2 ? "selected" : "" ?>>J.R.R. Tolkien</option>
                        <option value="3" <?= $idAutores == 3 ? "selected" : "" ?>>Clarice Lispector</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="idTipoPublicacao">Tipo de Publicação</label>
                    <select id="idTipoPublicacao" name="idTipoPublicacao">
                        <option value="1" <?= $idTipoPublicacao == 1 ? "selected" : "" ?>>Livro</option>
                        <option value="2" <?= $idTipoPublicacao == 2 ? "selected" : "" ?>>Revista</option>
                        <option value="3" <?= $idTipoPublicacao == 3 ? "selected" : "" ?>>Artigo</option>
                    </select>
                </div>

                <!-- Fixamos o evento/divulgação para simplificar -->
                <input type="hidden" name="idDivulgacao" value="1">

                <button type="submit" class="btn-submit">Salvar Publicação</button>
            </form>
            <a href="index.php" class="back-link">← Voltar para listagem</a>
        </div>
    </main>
</body>
</html>
