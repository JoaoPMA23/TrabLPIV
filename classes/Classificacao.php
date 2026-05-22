<?php
require_once __DIR__ . '/../databases/database.php';

class Classificacao extends Database {
    private $tableName = "classificacao";

    public $id;
    public $nome;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function lerTodos() {
        $query = "SELECT * FROM " . $this->tableName . " ORDER BY nome ASC";
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

    public function criar() {
        $query = "INSERT INTO " . $this->tableName . " SET nome=:nome";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $this->nome);
        return $stmt->execute();
    }

    public function atualizar() {
        $query = "UPDATE " . $this->tableName . " SET nome=:nome WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    public function deletar() {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}
?>
