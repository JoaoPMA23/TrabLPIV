<?php
/**
 * 1.1 Comentários: Classe base para configuração e conexão com o banco de dados.
 * 7.1 Classes (Métodos e Atributos): A classe define as propriedades de conexão e o método getConnection.
 */
class Database {
    // 2.1 Padrão utilizado: Atributos em camelCase
    protected $host = "localhost";
    protected $dbName = "livraria";
    protected $username = "root";
    protected $password = "";
    
    public $conn;

    /**
     * 8.1 Funções (Métodos): Método que estabelece e retorna a conexão.
     * @return PDO|null
     */
    public function getConnection() {
        $this->conn = null;

        try {
            // 9.1 Banco de Dados - Conexão PDO
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
            
            // Configura o PDO para relatar erros (lançar exceções)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Define o charset para evitar problemas com acentuação
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            // 3.2 Operador de String: Concatenação (.)
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>