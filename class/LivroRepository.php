<?php

class LivroRepository {
    private $pdo;

    // Construtor que recebe a conexão PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para adicionar um livro
    public function add(Livro $livro) {
        $stmt = $this->pdo->prepare("INSERT INTO livros (titulo, autor, ano, isbn) VALUES (?, ?, ?, ?)");
        $stmt->execute([$livro->getTitulo(), $livro->getAutor(), $livro->getAno(), $livro->getIsbn()]);
    }

    // Método para listar todos os livros
    public function list() {
        $stmt = $this->pdo->query("SELECT id, titulo, autor, ano, isbn FROM livros"); // Adicionado 'id' na seleção
        $livros = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Passa o ID para o construtor se Livro puder recebê-lo, ou armazena separadamente
            // Para este exemplo, vamos retornar um array associativo com o ID
            $livros[] = [
                'id' => $row['id'],
                'livro' => new Livro($row['titulo'], $row['autor'], $row['ano'], $row['isbn'])
            ];
        }
        return $livros;
    }

    // NOVO MÉTODO: Método para encontrar um livro pelo ID
    public function findById($id) {
        $stmt = $this->pdo->prepare("SELECT id, titulo, autor, ano, isbn FROM livros WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return [
                'id' => $row['id'],
                'livro' => new Livro($row['titulo'], $row['autor'], $row['ano'], $row['isbn'])
            ];
        }
        return null; // Retorna null se o livro não for encontrado
    }

    // Método para editar um livro existente
    public function edit($id, Livro $livro) {
        $stmt = $this->pdo->prepare("UPDATE livros SET titulo = ?, autor = ?, ano = ?, isbn = ? WHERE id = ?");
        $stmt->execute([$livro->getTitulo(), $livro->getAutor(), $livro->getAno(), $livro->getIsbn(), $id]);
    }

    // Método para excluir um livro
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM livros WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>
