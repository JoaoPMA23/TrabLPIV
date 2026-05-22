<?php
require_once __DIR__ . '/../databases/database.php';

/**
 * 7.1 Classes: Representa a entidade Autores
 * 7.3 Herança: Herda de Database
 */
class Autor extends Database {
    private $tableName = "autores";

    public $id;
    public $nome;
    public $idClassificacao;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    // 9.2 Leitura
    public function lerTodos() {
        $query = "SELECT a.*, c.nome as classificacao_nome 
                  FROM " . $this->tableName . " a
                  LEFT JOIN classificacao c ON a.idClassificacao = c.id
                  ORDER BY a.nome ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function lerUm($idBuscado) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $idBuscado);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 9.5 Inserção
    public function criar() {
        $query = "INSERT INTO " . $this->tableName . " SET nome=:nome, idClassificacao=:idClassificacao";
        $stmt = $this->conn->prepare($query);
        
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":idClassificacao", $this->idClassificacao);

        return $stmt->execute();
    }

    // 9.3 Atualização
    public function atualizar() {
        $query = "UPDATE " . $this->tableName . " SET nome=:nome, idClassificacao=:idClassificacao WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        $this->nome = htmlspecialchars(strip_tags($this->nome));

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":idClassificacao", $this->idClassificacao);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // 9.4 Deleção
    public function deletar() {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>
