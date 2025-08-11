<?php
require_once '../class/Livro.php';
require_once '../class/LivroRepository.php';

// Conexão com o banco de dados MySQL
$pdo = new PDO('mysql:host=localhost;dbname=sistema_livros', 'root', '&tec77@info!');
$livroRepo = new LivroRepository($pdo);

// Função para sanitizar e validar input
function sanitizarInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    // Remove caracteres especiais (exceto alguns permitidos)
    $input = preg_replace('/[^\w\sáàâãéèêíïóôõöúçñÁÀÂÃÉÈÊÍÏÓÔÕÖÚÇÑ.,-]/u', '', $input);
    return $input;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $erros = [];
    
    // Sanitiza e valida cada campo
    $titulo = isset($_POST['titulo']) ? sanitizarInput($_POST['titulo']) : '';
    $autor = isset($_POST['autor']) ? sanitizarInput($_POST['autor']) : '';
    $ano = isset($_POST['ano']) ? (int)$_POST['ano'] : 0;
    $isbn = isset($_POST['isbn']) ? preg_replace('/[^0-9-]/', '', $_POST['isbn']) : '';
    
    // Validações adicionais
    if (empty($titulo)) $erros[] = "Título é obrigatório";
    if (empty($autor)) $erros[] = "Autor é obrigatório";
    if ($ano <= 0) $erros[] = "Ano deve ser um número positivo";
    if (empty($isbn)) $erros[] = "ISBN é obrigatório";
    
    if (empty($erros)) {
        $livro = new Livro($titulo, $autor, $ano, $isbn);
        $livroRepo->add($livro);
        header('Location: ../index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Livro</title>
    <script src="../assets/js/validacao.js"></script>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Adicionar Livro</h1>
    
    <?php if (!empty($erros)): ?>
        <div class="error">
            <?php foreach ($erros as $erro): ?>
                <p><?php echo $erro; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" onsubmit="return validarFormulario()">
        <div>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" 
                   oninput="validarCampoTexto(this)" required>
        </div>
        
        <div>
            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" 
                   oninput="validarCampoTexto(this)" required>
        </div>
        
        <div>
            <label for="ano">Ano:</label>
            <input type="number" id="ano" name="ano" min="1" required>
        </div>
        
        <div>
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" 
                   oninput="validarISBN(this)" required>
        </div>
        
        <button type="submit">Adicionar Livro</button>
    </form>
    
    <a href="../index.php">Voltar para a lista de livros</a>
    
    <script>
        function validarFormulario() {
            // Validação adicional no submit se necessário
            return true;
        }
    </script>
</body>
</html>
