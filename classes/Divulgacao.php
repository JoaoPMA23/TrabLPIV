<?php
require_once __DIR__ . '/../databases/database.php';

class Divulgacao extends Database {
    private $tableName = "divulgacao";

    public $id;
    public $evento_nome;
    public $idConvidados;

    public function __construct() {
        $this->conn = $this->getConnection();
    }

    public function lerTodos() {
        $query = "SELECT d.*, c.nome as convidado_nome 
                  FROM " . $this->tableName . " d
                  LEFT JOIN convidados c ON d.idConvidados = c.id
                  ORDER BY d.evento_nome ASC";
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
        $query = "INSERT INTO " . $this->tableName . " SET evento_nome=:evento_nome, idConvidados=:idConvidados";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":evento_nome", $this->evento_nome);
        $stmt->bindParam(":idConvidados", $this->idConvidados);
        
        return $stmt->execute();
    }

    public function atualizar() {
        $query = "UPDATE " . $this->tableName . " SET evento_nome=:evento_nome, idConvidados=:idConvidados WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":evento_nome", $this->evento_nome);
        $stmt->bindParam(":idConvidados", $this->idConvidados);
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
