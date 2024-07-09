<?php
$host = 'localhost';
include "header.php";
require_once "connection/Database.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    $database = new Database();
    $db = $database->getConnection();

    $stmt = $db->prepare("
        INSERT INTO produtos 
            (nome, preco, descricao) 
        VALUES (:nome, :preco, :descricao)
    ");
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":preco", $preco);
    $stmt->bindParam(":descricao", $descricao);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success text-center">Produto inserido com sucesso</div>';
    } else {
        echo '<div class="alert alert-danger text-center">Erro ao inserir o produto</div>';
    }

    if (empty($nome) || empty($preco) || empty($descricao)) {
        echo '<div class="alert alert-danger text-center">Todos os campos são obrigatórios</div>';
    } elseif (!is_numeric($preco)) {
        echo '<div class="alert alert-danger text-center">O preço deve ser um valor numérico</div>';
    } else {
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <form action="" method="post">
                <label for="nome" class="form-label">Nome do Produto</label>
                <input type="text" name="nome" id="nome" class="form-control">
                <label for="preco" class="form-label">Preço do Produto</label>
                <input type="text" name="preco" id="preco" class="form-control">
                <label for="descricao" class="form-label">Descrição do Produto</label>
                <textarea class="form-control" name="descricao" id="descricao"></textarea>
                <button type="submit" class="btn btn-primary mt-3">Enviar</button>
            </form>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
