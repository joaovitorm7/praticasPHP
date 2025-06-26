<?php
include 'conexao.php';

$conn->query("DELETE FROM produtos");
$conn->close();

header("Location: carinho.php");
exit();
?>
