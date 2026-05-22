<?php
require_once __DIR__ . '/../databases/database.php';

/**
 * 1.1 Comentários: Classe que representa a entidade Publicacao.
 * 7.1 Classes (Métodos e Atributos)
 * 7.3 Uso de Herança: Publicacao herda os recursos de conexão de Database
 */
class Publicacao extends Database {
    
    // 2.1 Padrão utilizado: camelCase
    private $tableName = "publicacao";

    // Atributos mapeando as colunas do banco
    public $id;
    public $titulo;
    public $nota;
    public $descricao;
    public $imagem;
    public $idDivulgacao;
    public $idAutores;
    public $idTipoPublicacao;

    /**
     * 8.1 Funções com passagem de parâmetros (neste caso, construtor vazio, mas funções abaixo têm)
     */
    public function __construct() {
        // Inicia a conexão que vem da classe pai Database
        $this->conn = $this->getConnection();
    }

    /**
     * 9.2 Leitura e apresentação de registro
     * 8.1 Funções com passagem de parâmetros ($limite com valor default)
     */
    public function lerTodas($limite = null) {
        // 3.3 Operador de Atribuição (=) e 3.2 String (concatenação)
        $query = "SELECT p.*, a.nome as autor_nome, t.nome as tipo_nome 
                  FROM " . $this->tableName . " p 
                  LEFT JOIN autores a ON p.idAutores = a.id
                  LEFT JOIN tipo_publicacao t ON p.idTipoPublicacao = t.id
                  ORDER BY p.id DESC";

        // 6.1 Controle de Fluxo: If_Else
        // 3.4 Comparação (!=)
        if ($limite != null) {
            $query .= " LIMIT " . $limite;
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * 9.5 Inserção no Banco de Dados
     * @return boolean
     */
    public function criar() {
        $query = "INSERT INTO " . $this->tableName . "
                  SET titulo=:titulo, nota=:nota, descricao=:descricao, 
                      imagem=:imagem, idDivulgacao=:idDivulgacao, 
                      idAutores=:idAutores, idTipoPublicacao=:idTipoPublicacao";

        $stmt = $this->conn->prepare($query);

        // Bind de parâmetros
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":nota", $this->nota);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":imagem", $this->imagem);
        $stmt->bindParam(":idDivulgacao", $this->idDivulgacao);
        $stmt->bindParam(":idAutores", $this->idAutores);
        $stmt->bindParam(":idTipoPublicacao", $this->idTipoPublicacao);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * 9.2 Leitura (apenas 1 registro)
     * 8.1 Funções com passagem de parâmetros
     */
    public function lerUm($idBuscado) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idBuscado);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 9.3 Atualização
     */
    public function atualizar() {
        $query = "UPDATE " . $this->tableName . "
                  SET titulo=:titulo, nota=:nota, descricao=:descricao, 
                      imagem=:imagem, idDivulgacao=:idDivulgacao, 
                      idAutores=:idAutores, idTipoPublicacao=:idTipoPublicacao
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":nota", $this->nota);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":imagem", $this->imagem);
        $stmt->bindParam(":idDivulgacao", $this->idDivulgacao);
        $stmt->bindParam(":idAutores", $this->idAutores);
        $stmt->bindParam(":idTipoPublicacao", $this->idTipoPublicacao);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * 9.4 Deleção
     */
    public function deletar() {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
