<?php 

$host = "localhost";
$db = "carinhoCompras";
$user = "root"; 
$pass = "joao123";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

?>