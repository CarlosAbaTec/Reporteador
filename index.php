<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"></head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
    <body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mx-4">
  <a class="navbar-brand" href="index.php">Inicio</a>
</nav>
        <div class="row w-100">
            <div class="col-md-4"></div>
            <div class="col-md-4 mx-auto d-block">
                <img class="mx-auto d-block" style="width: 10rem;" src="img/LOGO.jpg" alt="">
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="container mx-auto ml-auto d-block my-4">
            <div class="card">
                <div class="card-body" style="background: #cecece;border-radius: 0.3rem;">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="list-group">
                                        <p class="list-group-item list-group-item-action active">Archivos</p>
                                        <div style="height:19rem;overflow:auto;">

                                        <?php
                                            $thefolder = "uploads1/";
                                            $c=0;
                                            if ($handler = opendir($thefolder)) {
                                                while (false !== ($file = readdir($handler))) {
                                                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                                                    $c+=1;
                                                    if($c>=3){



                                                        if ($extension=="dat"){
                                                            ?>
                                                        <a href="pre.php?doc=uploads1/<?php echo $file;?>" class="list-group-item list-group-item-action"><?php echo $file;?></a>

                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                                <a href="formfull.php?name=uploads1/<?php echo $file;?>" class="list-group-item list-group-item-action"><?php echo $file;?></a>
                                                            
                                                            <?php
                                                            
                                                            
                                                            
                                                        }
                                                        
                                                    }
                                                    
                                                        
                                                }
                                                closedir($handler);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3 style="text-align: center; text-transform: uppercase;">Sistema de reportes</h3>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <button class="btn btn-outline-success mx-auto d-block" data-bs-toggle="modal" data-bs-target="#modalReloj">
                                                <img style="max-width: 9rem;" src="img/escaner.png" alt="escaner">
                                                <p class="card-subtitle">Checador</p>
                                            </button>
                                        </div>
                                        <div class="col-md-2"> 
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalReloj2">
                                                <img style="max-width: 3rem;" src="img/excel.png" alt="">
                                                <p>Convertir .dat</p>
                                            </button> 
                                        </div>
                                        <div class="col-md-5">
                                            <button class="btn btn-outline-success mx-auto d-block" data-bs-toggle="modal" data-bs-target="#modalOdoo">
                                                <img style="max-width: 9rem;" src="img/system.png" alt="sistema">
                                                <p class="card-subtitle">Sistema Odoo</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="card">
                                <div class="card-body">
                                    <button class="btn btn-success mx-auto d-block w-75" data-bs-toggle="modal" data-bs-target="#modalIDs">Agregar lista de ID's</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="list-group">
                                        <p class="list-group-item list-group-item-action active">Archivos</p>
                                        <div style="height:19rem;overflow:auto;">

                                        <?php
                                            $thefolder = "uploads2/";
                                            $c=0;
                                            if ($handler = opendir($thefolder)) {
                                                while (false !== ($file = readdir($handler))) {
                                                    $c+=1;
                                                    if($c>=3){
                                                        ?>
                                                        <a href="index2.php?data=uploads2/<?php echo $file;?>" class="list-group-item list-group-item-action"><?php echo $file;?></a>
                                                        <?php
                                                    }
                                                }
                                                closedir($handler);
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <i class="small">El cargado de archivos del reloj checador debe estár de forma original, si es modificado puede que el sistema no lo lea.</i>
        </div>
        <!--  Modal Odoo  -->
        <div class="modal fade" id="modalOdoo" tabindex="-1" role="dialog" aria-labelledby="modalOdoo" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sistema Odoo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="externo2.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ARCHIVO DE DATOS</label>
                                <input type="file" name="archivo" id="archivo">
                                <p id="emailHelp" class="form-text">Solo puedes subir archivos excel</p>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal reloj -->
        <div class="modal fade" id="modalReloj" tabindex="-1" role="dialog" aria-labelledby="modalReloj" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reloj checador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="externo.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ARCHIVO DE DATOS</label>
                                <input required type="file" name="archivo" id="archivo">
                                <div id="emailHelp" class="form-text">Solo puedes subir archivos excel</div>
                            </div>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal reloj 2 -->
        <div class="modal fade" id="modalReloj2" tabindex="-1" role="dialog" aria-labelledby="modalReloj2" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reloj checador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="externo3.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ARCHIVO DE DATOS</label>
                                <input type="file" name="archivo" id="archivo">
                                <div id="emailHelp" class="form-text">Solo puedes subir archivos excel y dat</div>
                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal add id -->
        <div class="modal fade" id="modalIDs" tabindex="-1" role="dialog" aria-labelledby="modalIDs" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Relacionador de IDs</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="addids.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">ARCHIVO DE DATOS</label>
                                <input type="file" name="archivo" id="archivo">
                                <div id="emailHelp" class="form-text">Solo puedes subir archivos excel</div>
                            </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
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
            }

        }

    </script>
</body>
</html>

