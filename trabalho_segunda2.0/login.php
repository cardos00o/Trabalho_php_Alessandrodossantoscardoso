<?php
include("sessao.php");

$usuarios = [
    "admin" => password_hash("1234", PASSWORD_DEFAULT),
    "user" => password_hash("1234", PASSWORD_DEFAULT)
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    if (isset($usuarios[$usuario]) && password_verify($senha, $usuarios[$usuario])) {
        $_SESSION["logado"] = true;
        $_SESSION["usuario"] = $usuario;
        $_SESSION["tipo"] = ($usuario == "admin") ? "admin" : "usuario";

        header("Location: index.php");
        exit();
    } else {
        $erro = "Login inválido";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <?php if (isset($erro)) { ?>
        <p style="color:red;"><?php echo $erro; ?></p>
    <?php } ?>

    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuário" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
</div>

<?php include("footer.php"); ?>

</body>
</html>