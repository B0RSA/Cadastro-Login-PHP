<?php
    require('db/conexao.php');
    $logado="";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $emailLogin = limpaPost($_POST['email']);
        $senhaLogin = limpaPost($_POST['senha']);

        $sql = $pdo->prepare("SELECT senha FROM cadastro WHERE email = ?");
        $sql->execute([$emailLogin]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($senhaLogin, $row['senha'])) {
            session_start();
            $_SESSION['email'] = $emailLogin;
            $logado = "Logado com sucesso!";
        } else {
            $logado = "As informações de login são inválidas!";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <form method="post" class="formulario">
        <label for="email">E-mail</label>
        <input type="email" name="email" placeholder="email@ex.com" required>
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>
        <input type="submit" id="botao" value="login">
        <a href="registro.php">Não tem uma conta? Clique aqui para criar</a>
    </form>
    <script>alert("<?php echo "$logado" ?>");</script>
</body>
</html>