<?php
//conexão
   require_once 'db_connect.php';


//sessão
   session_start();

   $id = $_SESSION['id_usuario'];
   $sql = "SELECT * FROM usuarios  WHERE id = '$id'";
   $resultado = mysqli_query($connect, $sql);
   $dados = mysqli_fetch_array($resultado);

   //encerrar conexão após pegar dados do banco
   mysqli_close($connect);


   if (!$dados) {
    die("Usuário não encontrado!");
  }
?>

<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <div style="width:50%;margin:5% auto; display:flex;flex-direction:column;">
        <h1 style="text-align:center">Olá <?php echo $dados['nome']; ?></h1>
        <a href="logout.php" style="display:flex;justify-content:center"><button style="margin-top:2%;width:20%" type="button" class="btn btn-dark">SAIR</button></a>
        </div>
        

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    </body>
</html>