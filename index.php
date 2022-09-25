<?php include("conexao.php"); // > conexão com o BD 

// > criando uma condição de login

if (isset($_POST['usuario']) && strlen($_POST['usuario']) > 0) {

    // criando seção
    if (!isset($_SESSION))
        session_start();

    $_SESSION['usuario'] = $mysqli->escape_string($_POST['usuario']);
    $_SESSION['senha'] = md5(md5($_POST['senha']));

    $sql_code = "SELECT senha, codigo FROM usuario WHERE usuario = '$_SESSION[usuario]'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    $dado = $sql_query->fetch_assoc();
    $total = $sql_query->num_rows;

    if ($total == 0) {
        $erro[] = "Este usuário não existe.";
    } else {

        if ($dado['senha'] == $_SESSION['senha']) {
            // verifica se tem alguém logado
            $_SESSION['usuario'] = $dado['codigo'];
        } else {
            $erro[] = "Senha incorreta.";
        }
    }

    if (count($erro) == 0 || !isset($erro)) {
        echo "<script>alert('Login efetuado com sucesso');location.href='sucesso.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <?php if (isset($erro) > 0)
        foreach ($erro as $msg) {
            echo "<p>$msg</p>";
        } ?>
    <div class="main-login">
        <div class="left-login">
            <h1>Faça login<br>Entre no nosso site!</h1>
            <img src="dragao-animado.svg" class="left-login-image" alt="Dragão animação">
        </div>
        <form method="POST" action="">
            <div class="right-login">
                <div class="card-login">
                    <h1>LOGIN</h1>
                    <div class="textfield">
                        <label for="usuario">Usuário</label>
                        <input value="<?php if (isset($_SESSION)) ['usuario']; ?>" type="text" name="usuario" placeholder="Usuário">
                    </div>
                    <div class="textfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" placeholder="Senha">
                    </div>
                    <button class="btn-login" type="submit">Login</button>
        </form>
    </div>
    </div>
    </div>
    <footer>
        <p><strong>
                <center>por Gabriela Diniz</center>
            </strong>.</p>
    </footer>
</body>

</html>