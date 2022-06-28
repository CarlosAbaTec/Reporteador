<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"></head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <title>Document</title>
</head>
<body>
<?php
$name=$_GET['name'];

?>
<div class="container mx-auto w-50">
    <div class="card ">
      <div class="card-body">
      <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reloj checador</h5>
                </div>
                    <div class="modal-body">

                        <div class="mb-3">
                        <input disabled hidden type="text" name="archivo" id="archivo" value="<?php echo $name;?>">

                            <label for="">Tu archivo es: </label>
                            <p disabled class="text-success"><?php echo $name;?></p>

                        </div>
                        <h5>Escoge una ruta de archivo de ID's</h5>
                        <?php
                        
                        $thefolder2 = "ids/";
                        $c=0;
                        if ($handler = opendir($thefolder2)) {
                            while (false !== ($file = readdir($handler))) {
                                $c+=1;
                                if($c>=3){
                                    if ($file != "." && $file != "..") {

                                        $info = pathinfo($file);
                                        $file_name =  basename($file,'.'.$info['extension']);                                       
                                    ?>
                                    <div class="mb-3 form-check">
                                        <input required onclick="master();" type="radio" name="flexRadioDefault" class="form-check-input" id="exampleCheck<?php echo $c-2;?>" value="<?php echo $file_name;?>">
                                        <label class="form-check-label" for="exampleCheck1<?php echo $c-2;?>"><?php echo $file_name;?></label>
                                    </div>
                                    <?php
                                    }
                                }
                            }
                            closedir($handler);
                        }
                        ?>
                        <input hidden type="text" id="totIDs" name="totIDs" value="<?php echo $c-2;?>">
                        <input hidden type="text" name="iden" id="idinput">

                        <p style="display: none;" id="statusy" class="btn btn-success">Estatus: <i class="fa-solid fa-check"></i></p>
                        <p id="statusn" class="btn btn-danger">Estatus: <i class="fa-solid fa-xmark"></i></p>

                    </div>
                    <div class="modal-footer">
                        <a id="send" class="btn btn-primary">Enviar</a>
                    </div>
            </div>
      </div>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script>
$(document).ready(function() {
var element=document.getElementById("idinput").value;
    revision(element);
});
function master(){
    
    var tot=document.getElementById("totIDs").value;
        console.log(tot);
        for ($i=0; $i<tot; $i++){
            inic($i);
        }
}

        function inic(elem){
            var elem= elem+1;
            var tot= "exampleCheck"+elem;
            console.log(tot);

            var checkbox = document.getElementById(tot);
            checkbox.addEventListener("change", validaCheckbox(checkbox), false);
        }
        function validaCheckbox(checkbox)
            {
            var checked = checkbox.checked;
            if(checked){                
                document.getElementById("idinput").value=checkbox.value;
                var element=document.getElementById("idinput").value

                revision(element);
            }
        }

        function revision(element){
            if (element!=""){
                 
                document.getElementById("statusn").style.display="none";
                document.getElementById("statusy").style.display="initial";
                $doc=document.getElementById("archivo").value;
                if (($doc[9]+$doc[10]+$doc[11])=="AT-"){
                    var link="preindex3.php?data="+$doc+"&zone=ids/"+element+".xls";
                    var a = document.getElementById('send');
                    a.href = link;
                }
                else{
                    var link="index1.php?data="+$doc+"&zone=ids/"+element+".xls";
                    var a = document.getElementById('send');
                    a.href = link;

                }

            }

        }

    </script>



</body>
</html>

<style>
    body{
        background-image: url("img/LOGO.jpg");
        background-repeat: repeat;
        background-size: 6rem;
    }
</style>