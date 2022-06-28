<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php


$name= $_FILES['archivo']['name'];
$tempname= $_FILES['archivo']['tmp_name'];

$exten = pathinfo($name, PATHINFO_EXTENSION);
$name_original = pathinfo($name, PATHINFO_FILENAME);

$extension=$name_original[0].$name_original[1].$name_original[2];
$rev=0;
if ($exten!="dat"){
    if ($extension=="AT-"){
        if (isset($_POST["iden"])) {
            $CHK=$_POST["iden"];
            $rev=1;
         } 
        $locacion="preindex3.php?data=";
    }
    else{
        $locacion="index1.php?data=";
        if (isset($_POST["iden"])) {
            $CHK=$_POST["iden"];
            $rev=1;
         } 

    }




$ruta="uploads1/".$name;
if($rev==1){
    $locationF=$locacion.$ruta."&zone=ids/".$CHK.".xls";
}
else{
    $locationF=$locacion.$ruta;
}
echo $extension;

if (file_exists($ruta)) {
    
    $name_origin = pathinfo($name, PATHINFO_FILENAME);
    

    
    $date = new DateTime();
    $date2= $date->format('YmdHis');
    $renombre=$name_origin.$date2.".".$exten;
    $ruta2="uploads1/".$renombre;

    move_uploaded_file($tempname,$ruta2);
    ?>
    <script>
        Swal.fire({
        title: '<?php echo $name . " ya existe";?>',
        text: 'Tu archivo fue renombrado a <?php echo $renombre;?>!',
        icon: 'warning',
        confirmButtonText: 'Continuar',
        }).then((result) => {

            window.location.href = '<?php echo $locationF;?>';
        });
    </script>
    <?php

  } 
  else {
   // Si no es un archivo repetido y no hubo ningun error, procedemos a subir a la carpeta /archivos, seguido de eso mostramos la imagen subida
    move_uploaded_file($tempname,$ruta);
    ?>
    <script>
        Swal.fire({
        title: 'Tu archivo se ha subido con exito',
        confirmButtonText: 'Save',
        icon: 'success',
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            window.location.href = '<?php echo $locationF;?>';
        } 
        });
    </script>
    <?php
}
}
else{
    ?>
    <script>
        Swal.fire({
        title: 'Ese tipo de archivo no es valido aqui',
        confirmButtonText: 'Volver',
        icon: 'error',
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            window.location.href = 'index.php';
        } 
        });
    </script>
    <?php
}
?>

</body>
</html>
