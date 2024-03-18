<?php
    require('db/conexao.php');
    $erro="";
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome=limpaPost($_POST['nome']);
        $sobrenome=limpaPost($_POST['sobrenome']);
        $email=limpaPost($_POST['email']);
        $senha=limpaPost($_POST['senha']);
        $Rsenha=limpaPost($_POST['Rsenha']);
        if($senha!=$Rsenha){
            $erro="As senhas não coincidem!";
        }else{
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = $pdo->prepare("INSERT INTO cadastro VALUES(?,?,?,?)");
            $sql->execute(array($nome,$sobrenome,$email, $senhaHash));
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senhaHash;
            header("Location: login.php");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Registro</title>
</head>
<body>
    <form method="post" class="formulario">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" placeholder="Exemplo" required>
        <label for="sobrenome">Sobrenome</label>
        <input type="text" name="sobrenome" id="nome" placeholder="Sobrenome" required>
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" placeholder="email@ex.com" required>
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required>
        <label for="Rsenha">Repita a senha</label>
        <input type="password" name="Rsenha" id="Rsenha" required>
        <p><?php echo "$erro"?></p>
        <input type="submit" id="botao" value="Registrar-se">
        <a href="login.php">Ja tem uma conta? clique aqui para logar</a>
    </form>
</body>
</html>