<?php
$host = 'localhost';
include "header.php";
require_once "connection/Database.php";

$database = new Database();
$db = $database->getConnection();

$stmt = $db->prepare("SELECT * FROM produtos");
$stmt->execute();

$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Lista de Produtos</h2>
            <?php foreach ($resultado as $row): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['nome']); ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo "R$ " . $row['preco']; ?></h6>
                        <p class="card-text"><?php echo htmlspecialchars($row['descricao']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
