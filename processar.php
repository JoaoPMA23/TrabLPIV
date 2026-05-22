<?php
// 1.1 Comentários: Arquivo que recebe os dados dos formulários e processa as ações.
require_once __DIR__ . '/classes/Publicacao.php';

// 7.4 Instanciação de Objetos
$publicacao = new Publicacao();

// 4.1 Array: Utilizado para armazenar mensagens de erro de validação
$erros = [];

// Verifica qual ação foi solicitada (via POST do form ou GET do link de exclusão)
// 6.3 Operador Ternário (?:)
$acao = isset($_POST['acao']) ? $_POST['acao'] : (isset($_GET['acao']) ? $_GET['acao'] : '');

// 6.2 Controle de Fluxo: Switch
switch ($acao) {
    case 'inserir':
        // 3.3 Atribuição
        $publicacao->titulo = $_POST['titulo'];
        $publicacao->nota = $_POST['nota'];
        $publicacao->descricao = $_POST['descricao'];
        $publicacao->imagem = $_POST['imagem'];
        $publicacao->idDivulgacao = $_POST['idDivulgacao'];
        $publicacao->idAutores = $_POST['idAutores'];
        $publicacao->idTipoPublicacao = $_POST['idTipoPublicacao'];

        // 6.1 Controle de Fluxo (If_Else) e 3.6 Lógico (!)
        if (empty($publicacao->titulo)) {
            $erros[] = "O título é obrigatório.";
        }

        // 3.4 Comparação (==)
        if (count($erros) == 0) {
            if($publicacao->criar()) {
                // Redireciona com sucesso
                header("Location: index.php?msg=criado");
            } else {
                echo "Erro ao cadastrar a publicação no banco de dados.";
            }
        } else {
            echo "<h3>Foram encontrados os seguintes erros:</h3>";
            // 5.2 Laços: Foreach (iterando no array criado na rubrica 4.1)
            foreach ($erros as $erro) {
                // 3.2 String (concatenação implícita em aspas duplas)
                echo "<p style='color:red;'>- $erro</p>";
            }
            echo "<a href='cadastrar.php'>Voltar e tentar novamente</a>";
        }
        break;

    case 'atualizar':
        $publicacao->id = $_POST['id'];
        $publicacao->titulo = $_POST['titulo'];
        $publicacao->nota = $_POST['nota'];
        $publicacao->descricao = $_POST['descricao'];
        $publicacao->imagem = $_POST['imagem'];
        $publicacao->idDivulgacao = $_POST['idDivulgacao'];
        $publicacao->idAutores = $_POST['idAutores'];
        $publicacao->idTipoPublicacao = $_POST['idTipoPublicacao'];

        if($publicacao->atualizar()) {
            header("Location: index.php?msg=atualizado");
        } else {
            echo "Erro ao atualizar a publicação.";
        }
        break;

    case 'deletar':
        $publicacao->id = $_GET['id'];
        
        // 3.6 Lógico (&& - E lógico)
        if(isset($publicacao->id) && !empty($publicacao->id)) {
            if($publicacao->deletar()) {
                header("Location: index.php?msg=deletado");
            } else {
                echo "Erro ao deletar.";
            }
        }
        break;

    default:
        // Ação não reconhecida
        header("Location: index.php");
        break;
}
?>
