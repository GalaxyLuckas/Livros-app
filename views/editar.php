<?php
require_once '../class/Livro.php';
require_once '../class/LivroRepository.php';

// Conexão com o banco de dados MySQL
$pdo = new PDO('mysql:host=localhost;dbname=sistema_livros', 'root', '&tec77@info!');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$livroRepo = new LivroRepository($pdo);

// Verifica se o ID do livro a ser editado foi passado
if (!isset($_GET['id'])) {
    header('Location: ../index.php');
    exit;
}

$id = (int)$_GET['id'];

// Busca o livro pelo ID do banco de dados
$livroData = $livroRepo->findById($id);

// Verifica se o livro existe
if (!$livroData) {
    header('Location: ../index.php');
    exit;
}

$livro = $livroData['livro'];
$livroId = $livroData['id'];

// Processa o formulário de atualização/deleção
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica qual botão foi pressionado
    if (isset($_POST['atualizar'])) {
        // Atualizar livro
        $livroAtualizado = new Livro(
            $_POST['titulo'],
            $_POST['autor'],
            $_POST['ano'],
            $_POST['isbn']
        );
        $livroRepo->edit($livroId, $livroAtualizado);
        header('Location: ../index.php');
        exit;
    } elseif (isset($_POST['deletar'])) {
        // Deletar livro
        $livroRepo->delete($livroId);
        header('Location: ../index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
</head>
<body>
    <div class="container">
        <h1>Editar Livro</h1>
        
        <form method="POST">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($livro->getTitulo()); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($livro->getAutor()); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="ano">Ano:</label>
                <input type="number" id="ano" name="ano" value="<?php echo htmlspecialchars($livro->getAno()); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($livro->getIsbn()); ?>" required>
            </div>
            
            <div class="btn-group">
                <button type="submit" name="atualizar" class="btn btn-primary">Atualizar Livro</button>
                <button type="submit" name="deletar" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este livro?')">Deletar Livro</button>
                <a href="../index.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
