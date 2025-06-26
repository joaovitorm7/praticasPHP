<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $quantidade = (int) $_POST['quantidade'];
    $preco_unitario = (float) $_POST['preco_unitario'];

    $stmt = $conn->prepare("INSERT INTO produtos (item, quantidade, preco_unitario) VALUES (?, ?, ?)");
    $stmt->bind_param("sid", $item, $quantidade, $preco_unitario);

    if ($stmt->execute()) {
        header("Location: carinho.php");
        exit();
    } else {
        echo "Erro ao adicionar produto: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>
