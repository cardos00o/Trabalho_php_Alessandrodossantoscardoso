<?php
include("sessao.php");

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST["limpar"]) && $_SESSION["tipo"] == "admin") {
    $_SESSION["transacoes"] = [];
    header("Location: historico.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Historico</title>
    <link rel="stylesheet" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="topo">
    <h2>Histórico</h2>
    <a href="index.php">Voltar</a>
</div>

<div class="container">

<table>
<tr>
    <th>Descrição</th>
    <th>Tipo</th>
    <th>Valor</th>
</tr>

<?php
if (count($_SESSION["transacoes"]) == 0) {
    echo "<tr><td colspan='3'>Nenhuma transação</td></tr>";
} else {
    foreach ($_SESSION["transacoes"] as $t) {

        $classe = $t["tipo"] == "receita" ? "receita-texto" : "despesa-texto";

        echo "<tr>";
        echo "<td>" . htmlspecialchars($t["nome"]) . "</td>";
        echo "<td class='$classe'>{$t["tipo"]}</td>";
        echo "<td>R$ " . number_format($t["valor"], 2, ',', '.') . "</td>";
        echo "</tr>";
    }
}
?>

</table>

<?php if ($_SESSION["tipo"] == "admin") { ?>
<form method="POST" style="margin-top:20px;">
    <button name="limpar" class="btn-admin">Limpar Histórico</button>
</form>
<?php } ?>

</div>

<?php include("footer.php"); ?>

</body>
</html>