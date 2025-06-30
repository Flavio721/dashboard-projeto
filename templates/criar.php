<?php
  if(isset($_POST['submit']))
    {
      // print_r('Nome: ' . $_POST['nome']);
      // print_r('<br>');
      // print_r('Email: ' . $_POST['email']);
      // print_r('<br>');
      // print_r('Senha: ' . $_POST['senha']);
      // print_r('<br>');
      include_once('processa.php');

      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $senha = $_POST['senha'];

      $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, senha) VALUES ('$nome', '$email', '$senha')");
      header("Location: perfil.html");
      exit();
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="static/style5.css">
  </head>
  <body>
    <section>
      <form method="post" action="criar.php">        
          <label for="inome">Nome</label>
          <input type="text" name="nome" id="inome" class="form-control" placeholder="Nome" maxlength="30">
          
          <label for="iemail">Email</label>
          <input type="email" name="email" id="iemail" class="form-control" placeholder="Email" maxlength="50">
          
          <label for="isenha">Senha</label>
          <input type="password" name="senha" id="isenha" class="form-control" placeholder="Senha" maxlength="20">
          
          <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
      </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>