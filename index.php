<?php
require_once 'class/Livro.php';
require_once 'class/LivroRepository.php';

// Conexão com o banco de dados MySQL
$pdo = new PDO('mysql:host=localhost;dbname=sistema_livros', 'root', '&tec77@info!'); // Substitua 'usuario' e 'senha' pelos seus dados

$livroRepo = new LivroRepository($pdo);

// Verifica se o formulário foi enviado (este bloco é para adicionar, mas o index.php não deveria adicionar diretamente)
// Se você quer adicionar do index, o formulário deve estar aqui.
// Como você tem adicionar.php, este bloco pode ser removido ou adaptado.
// Por enquanto, vou mantê-lo, mas é redundante com adicionar.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro = new Livro($_POST['titulo'], $_POST['autor'], $_POST['ano'], $_POST['isbn']);
    $livroRepo->add($livro);
    // Redirecionar para evitar reenvio do formulário ao recarregar a página
    header('Location: index.php');
    exit;
}

// Obtém a lista de livros do repositório
$livrosData = $livroRepo->list(); // Renomeado para evitar conflito com $livros no foreach
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Livros</title>
</head>
<body>
    <h1>Cadastro de Livros</h1>
    <a href="views/adicionar.php">Adicionar Novo Livro</a>

    <h2>Lista de Livros</h2>
    <ul>
        <?php foreach ($livrosData as $data): // Itera sobre o array que contém 'id' e 'livro' ?>
            <li>
                <?php echo $data['livro']->getTitulo(); ?> - <?php echo $data['livro']->getAutor(); ?>
                <a href="views/editar.php?id=<?php echo $data['id']; ?>">Editar</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
