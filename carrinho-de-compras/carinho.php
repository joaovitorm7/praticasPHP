<?php
include 'conexao.php';

$total_compra = 0;
$itens_com_desconto = 0;
$produtos_html = "";

$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($produto = $result->fetch_assoc()) {
        $subtotal = $produto["quantidade"] * $produto["preco_unitario"];
        $desconto_aplicado = false;

        if ($produto["quantidade"] > 1 && $produto["preco_unitario"] > 50) {
            $subtotal *= 0.90;
            $itens_com_desconto++;
            $desconto_aplicado = true;
        }

        $total_compra += $subtotal;

        $produtos_html .= "<div class='produto'>";
        $produtos_html .= "<div>{$produto['item']} (x{$produto['quantidade']})</div>";
        $produtos_html .= "<div>
            R$ " . number_format($subtotal, 2, ',', '.') .
            ($desconto_aplicado ? " <span class='desconto'>(-10%)</span>" : "") .
            " <form method='post' action='remover.php' style='display:inline'>
                <input type='hidden' name='id' value='{$produto['id']}'>
                <button type='submit' class='remover'>Remover</button>
              </form>
        </div>";
        $produtos_html .= "</div>";
    }

    if ($itens_com_desconto >= 2) {
        $total_compra *= 0.95;
    }
} else {
    $produtos_html .= "<p>Carrinho vazio.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Carrinho de Compras</h1>
        <?= $produtos_html ?>
        <div class="total">
            Total da Compra: <strong>R$ <?= number_format($total_compra, 2, ',', '.') ?></strong>
        </div>

        <form action="limpar.php" method="post" style="text-align: right; margin-top: 20px;">
            <button type="submit" class="esvaziar">Esvaziar Carrinho</button>
            <a href="formulario.html" class="voltar">Voltar</a>
        </form>
    </div>
</body>
</html>
