<?php
if (isset($_POST['btn_agrega_usuario'])) {
    #echo "Nombre: ".$_POST["usuario"];
    #echo "Password: ".$_POST["password"];

    $archivo=fopen("usuarios.txt","a+");
    fwrite($archivo,$_POST["usuario"]."|".$_POST["password"]."\n");
    fclose($archivo);

    echo "<div class='alert alert-success' role='alert'>Se registro correctamente el usuario.</div>";
    fclose($archivo);
}
$tabla="";
$archivo=fopen("usuarios.txt","r");
$numRow=0;
while (!feof($archivo)) {
  $cad=fgets($archivo);
  $posi=0;
  for ($i=0; $i < strlen($cad); $i++) { 
    if ($cad[$i]=="|") {
      $posi=$i;
    }
  }
  if ($cad !="") {
   
   $tabla.= " <div class='row' style='background: #F7F4F2; color: #656563;'>
         <div class='col-md-6' style='border: 1px dashed #FCFFE3; text-align: center;'>[$numRow]".substr($cad, 0,$posi)."</div>
         <div class='col-md-6' style='border: 1px dashed #FCFFE3; text-align: center;'>
          <form action='' method='POST'>
            <input type='hidden' name='usuario' value='".substr($cad, 0,$posi)."'>
            <input type='hidden' name='password' value='".substr($cad,$posi+1, strlen($cad)-1)."'>
            <input type='hidden' name='index' value='$numRow' >
           <input type='submit' value='Detalles' name='btn_acciones' class='btn btn-sm btn-secondary'>
          </form>
          <form action='' method='POST'>
          <input type='hidden' name='usuario' value='".substr($cad, 0,$posi)."'>
          <input type='hidden' name='password' value='".substr($cad,$posi+1, strlen($cad)-1)."'>
          <input type='hidden' name='index' value='$numRow' >
          <input type='submit' name='btn_acciones' value='Modificar' class='btn btn-sm btn-info'>
          </form>
          <form action='' method='POST'>
          <input type='hidden' name='usuario' value='".substr($cad, 0,$posi)."'>
          <input type='hidden' name='password' value='".substr($cad,$posi+1, strlen($cad)-1)."'>
          <input type='hidden' name='index' value='$numRow' >
          <input type='submit' name='btn_acciones' value='Eliminar' class='btn btn-sm btn-danger'>
          </form>
         </div>
      </div>";
      $numRow++;
    }
}
    fclose($archivo);

   $formularioAcciones=""; 

  if (isset($_POST["btn_acciones"])) {
    var_dump($_POST);
    switch ($_POST["btn_acciones"]) {
      case 'Detalles':
        $formularioAcciones.="<div class'row'>
                               <div class='col-md-4'></div>
                               <div class='col-md-4'>
                                 <h2>Detalles usuario</h2>
                                 <h3>#".$_POST["index"]."</h3>
                                 <input type='text' readOnly name='usuario' placeholder='Nombre usuario' class='form-control' value='".$_POST['usuario']."'/>
                                 <input type='text' readOnly name='password' placeholder='Contraseña' class='form-control' style='margin: 5px auto;' value='".$_POST['password']."'/>
                                </div>
                               <div class='col-md-4'></div>
                              </div>";
        
        break;


      case 'Modificar':
        echo "Hola";
        $formularioAcciones.="<div class'row'>
        <div class='col-md-4'></div>
        <div class='col-md-4'>
        <form action='' method='POST'>
          <h2>Modificar usuario</h2>
          <h3>#".$_POST["index"]."</h3>
          <input type='hidden' value='".$_POST["index"]."' name='index'>
          <input type='text'  name='usuario' placeholder='Nombre usuario' class='form-control' value='".$_POST['usuario']."'/>
          <input type='text'  name='password' placeholder='Contraseña' class='form-control' style='margin: 5px auto;' value='".$_POST['password']."'/>
          <input type='submit' name='btn_acciones' value='Guardar modificar' class='w-100 btn btn-success'>
        </form>
          </div>
        <div class='col-md-4'></div>
       </div>";
        break;
       
       
      case 'Guardar modificar':
                   var_dump($_POST);
         
         $formularioAcciones= "<div class='alert alert-success' role='alert'>El usuario se modifico exitosamente el usuario.</div>";
        break;


      case 'Eliminar':
        borrar_linea($_POST['index']);
        break; 
        
        
      default:
        # code...
        break;
    }
  }

  function borrar_linea($linea) {
    echo "vamos a borrar $linea";
    $file = get_file("usuarios.txt");
    $nuevo_archivo = "";
    echo "<br>";
    for($i = 0; !feof($file); $i++) {
      $row = fgets($file);
      if ($i != $linea) {
        $nuevo_archivo.= $row;
      }
    }
    echo "<br>";
    fclose($file);
    $file = fopen("usuarios.txt","w+");
    fwrite($file, "hola|adios");
    fclose($file);
    echo "el fin brother";
  }
  function get_file($nombre) {
    $file = fopen($nombre, "r");
    return $file;
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

    <title>practica 3a</title>
  </head>
  <body>
   
    <h1>Bienvenido <?php echo $_GET["usuario"] ?></h1>

    <div class="container">
        <div class="row"><!--row formulario-->
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form action="" method="POST">
                <h2>Agregar usuario</h2>
                <input type="text" name="usuario" placeholder="Nombre usuario" class="form-control"/>
                <input type="text" name="password" placeholder="Contraseña" class="form-control" style="margin: 5px auto;"/>
                <input type="submit" name ="btn_agrega_usuario"value="Agregar usuario" class="w-100 btn btn-block btn-success"/>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div><!--fin row formulario-->
        
          <?php echo $formularioAcciones; ?>

        <div class="row" style='border: 0px solid cyan;'>
          <div class="col-md-12">
            <div class="row" style="background: #FEAA3D; color: #8E6025;">
              <div class="col-md-6" style="border: 1px dashed #FCFFE3; text-align: center;">Nombre usuario</div>
              <div class="col-md-6" style="border: 1px dashed #FCFFE3; text-align: center;">Acciones</div>
            </div>
          
          <?php echo $tabla; ?>



          </div>
        </div>
    </div>
  
  </body>
</html>