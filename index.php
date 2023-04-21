<?php 
    require_once 'classes/usuarios.php';
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Netwall</title>
</head>
<body>
    <div id="content">
        <h1><strong>Informações básicas</strong></h1>
        <form method="POST">
            <div class="content-input">
                <p class="label">Nome</p>
                <input type="text" placeholder="" name="nome" id="nome" class="entry">
            </div>
            <div class="content-input">
                <p class="label">E-mail</p>
                <input type="email" placeholder="" name="email" id="email" class="entry">
            </div>
        <input type="submit" value="Salvar" id="submit">
        </form>
    <?php 

    if(isset($_POST['nome']))
    {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);

        if(!empty($nome) && !empty($email))
        {
            $u->conectar("netwall","localhost","root","");
            if($u->msgErro == "")
            {
                if ($u->cadastrar($nome, $email)){
                    ?>
                    <div id="msg-sucesso">
                        <p>Cadastrado com sucesso.</p>
                    </div>
                    <?php 
                } else {
                    ?>
                    <div id="msg-erro">
                        <p>E-mail já existe.</p>
                    </div>
                    <?php
                }
            }
        }
    }

    ?>
    </div>
</body>
</html>