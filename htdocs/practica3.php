<?php

  if (isset($_POST["ingresar"])) {

    $archivo=fopen("usuarios.txt",'r');
    $cad="";
    $nom="";
    $pass="";
    $ban= false;

    while (!feof($archivo)) {
      $cad= fgets($archivo);
      $pos=0;

      for ($x=0; $x < strlen($cad); $x++) { 
        if ($cad[$x]=="|") {
          $pos= $x;
        }
      }

      $nom= substr($cad, 0, $pos);
      $pass=substr($cad, $pos+1, strlen(cad));
      #echo "Nombre: $nom<br/>";
      #echo "Password: $pass<br/>"."<br/>";


      if ($_POST["nombre"]==$nom && $_POST["password"]==trim($pass)) {$ban=True;}

    }
    fclose($archivo);
#sleep(3);
  
    if ($ban) {
      header("Location: practica3a.php?usuario=".$_POST['nombre']);
    }else{
      echo "<div class='alert alert-warning' role='alert'>Usuario o contraseña incorrecta.</div>";
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js" ></script>

    <title>practica 3</title>
  </head>
  <body>
   
    <div class="container" style="margin-top: 10%;">
      <div class="row">
        <div class="col-md-4" style='border: 0px solid #E8EA79;'></div>
        <div class="col-md-4" style='border: 1px solid #BCACA7;'>
          <div>
            <form action="" method="POST">
              <input type="text" name="nombre" class="form-control" placeholder="Nombre usuario">
              <input type="password" name="password" class="form-control" style="margin: 5px auto;">
              <input type="submit" value="Ingresar" class="w-100 btn-block btn-primary" name="ingresar">
            </form>
          </div>
       </div>
        <div class="col-md-4" style='border: 0px solid #E8EA79;'></div>
      </div>

    </div>
  
  </body>
</html>