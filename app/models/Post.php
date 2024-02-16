<?php
namespace app\models;
class Post {
    private $conn;
    private $table_name = "posts";

    // Propriedades do objeto
    public $id;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Construtor com $db como conexão ao banco de dados
    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para ler posts
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Outros métodos CRUD aqui (create, update, delete)
}
