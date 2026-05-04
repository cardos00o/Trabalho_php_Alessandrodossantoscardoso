<?php
include("sessao.php");
include("funcoes.php");

if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $valor = floatval($_POST["valor"]);
    $tipo = $_POST["tipo"];

    if ($nome == "" || $valor <= 0) {
        echo "<p style='color:red;'>Dados inválidos</p>";
    } else {
        $_SESSION["transacoes"][] = [
            "nome" => $nome,
            "valor" => $valor,
            "tipo" => $tipo
        ];
    }
}

$saldo = calcularSaldo($_SESSION["transacoes"]);
$receitas = calcularReceitas($_SESSION["transacoes"]);
$despesas = calcularDespesas($_SESSION["transacoes"]);
$percentual = calcularPercentualDespesas($_SESSION["transacoes"]);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
    <link rel="stylesheet" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="topo">
    <h2>Controle de Gasto</h2>
    <div>
        <?php echo $_SESSION["usuario"]; ?>
        <a href="logout.php">Sair</a>
    </div>
</div>

<div class="container">

<div class="dashboard">

    <div class="card receita">
        <h3>Receitas</h3>
        <p>R$ <?php echo number_format($receitas, 2, ',', '.'); ?></p>
    </div>

    <div class="card despesa">
        <h3>Despesas</h3>
        <p>R$ <?php echo number_format($despesas, 2, ',', '.'); ?></p>
        <p><?php echo round($percentual, 2); ?>% das receitas</p>
    </div>

    <div class="card total">
        <h3>Saldo</h3>
        <p>R$ <?php echo number_format($saldo, 2, ',', '.'); ?></p>
    </div>

</div>

<form method="POST">
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="number" step="0.01" name="valor" placeholder="Valor" required>

    <select name="tipo">
        <option value="receita">Receita</option>
        <option value="despesa">Despesa</option>
    </select>

    <button type="submit">Adicionar</button>
</form>

<a href="historico.php">Ver Histórico</a>

</div>

<?php include("footer.php"); ?>

</body>
</html>