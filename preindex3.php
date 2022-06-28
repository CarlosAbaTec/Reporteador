<?php
$data=$_GET['data'];
$zone=$_GET['zone'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <title>Empresas</title>
</head>
<body onload="revcheck();">

<div class="content d-block mt-5" style="margin-left:3rem;">
<input hidden value="<?php echo $data;?>" id="data" type="text">
<input hidden value="<?php echo $zone;?>" id="zone" type="text">
<h5>Seleccione la empresa que desea ver</h5>
<div class="form-check">
  <input onclick="revcheck();" class="form-check-input" type="checkbox" value="AbaTec" id="check1" checked>
  <label class="form-check-label" for="flexCheckDefault">AbaTec</label>
</div>
<div class="form-check">
  <input onclick="revcheck();" class="form-check-input" type="checkbox" value="HyT" id="check2" checked>
  <label class="form-check-label" for="flexCheckChecked">HyT Ingenieros</label>
</div>

<a id="send" class="btn btn-success">Acceder</a>
</div>



<script>
function revcheck(){
    $ch1=document.getElementById("check1"); // Modo 1 y Modo 0 ninguno
    $ch2=document.getElementById("check2"); // Modo 2 y Modo 3 ambos
    $data=document.getElementById("data").value;
    $zone=document.getElementById("zone").value;
    
    if ($ch1.checked){
        if ($ch2.checked){
            var link="index3.php?data="+$data+"&zone="+$zone+"&type=3";
        }
        else{
            var link="index3.php?data="+$data+"&zone="+$zone+"&type=1";
        }

    }
    else if($ch2.checked){
        if ($ch1.checked){
            var link="index3.php?data="+$data+"&zone="+$zone+"&type=3";
        }
        else{
            var link="index3.php?data="+$data+"&zone="+$zone+"&type=2";

        }
    }
    else{
        var link="index3.php?data="+$data+"&zone="+$zone+"&type=0";
    }
    var a = document.getElementById('send');
    a.href = link;
    
}


</script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    

</body>
</html>