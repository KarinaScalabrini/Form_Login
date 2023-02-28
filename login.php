<?php
//conexão
require_once 'db_connect.php';

// sessao
session_start();

// botão enviar
if(isset($_POST['btn-entrar'])):
    $erros = array();
    $login = mysqli_escape_string($connect, $_POST['login']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    if (empty($login) or empty($senha)):
        $erros[] = "<li>O campo precisa ser preenchido</li>";
    else:
        $sql = "SELECT login FROM usuarios WHERE login = '$login' ";
        $resultado = mysqli_query($connect, $sql);

        if(mysqli_num_rows($resultado) > 0):
            $senha = md5($senha);
            $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
            $resultado = mysqli_query($connect, $sql);
            
            if(mysqli_num_rows($resultado) == 1):
                $dados = mysqli_fetch_array($resultado);
                mysqli_close($connect);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['ID'];
                header('Location: home.php');

            else:
                $erros[] = "<li>Usuário e senha não confere</li>";
            endif;
        else:
            $erros[] = "<li>Usuário inexistente</li>";
        endif;
    endif;
endif;

?>
<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</heade>
<body>

<form style="width:50%;margin:15% auto;
border:1px solid #808080; padding:5%; border-radius:15px;background-color:#C0C0C0" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<h1>Login</h1><br><br>
<?php
if(!empty($erros)):
    foreach($erros as $erro):
        echo $erro;
    endforeach;
endif;
?>
  <div class="row mb-3">
    <label for="inputEmail" class="col-sm-2 col-form-label">Usuário:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputEmail" name="login">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="senha" class="form-control" id="inputPassword">
    </div>
  </div>
  <button style="margin-top:1%" type="submit" name="btn-entrar" class="btn btn-dark">ENTRAR</button>
</form>






<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>    