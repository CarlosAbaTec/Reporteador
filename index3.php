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
    <title>Reporte</title>
</head>
<body onload="GetCellValues();">
<nav class="navbar navbar-expand-lg navbar-light bg-light mx-4">
  <a class="navbar-brand" href="index.php">Inicio</a>
</nav>

<?php
$data=$_GET['data'];
$zone=$_GET['zone'];
$type=$_GET['type'];

error_reporting(0);
$meses31=['01','03','05','07','08','10','12'];
$arrdays=[];
$arreglo=excelToArray($data);

$usuarios=excelToArray($zone);


$fechaInicio=($arreglo[0]['Fecha']);
$fechaFin=($arreglo[count($arreglo)-1]['Fecha']);

$fechaSeparada = explode("-", $fechaInicio);
$anyo = $fechaSeparada[0];
$mes = $fechaSeparada[1];
$dia = $fechaSeparada[2];

$fechaSeparada2 = explode("-", $fechaFin);
$anyo2 = $fechaSeparada2[0];
$mes2 = $fechaSeparada2[1];
$dia2 = $fechaSeparada2[2];

$date1=$anyo."-".$mes."-".$dia;
$date2=$anyo2."-".$mes2."-".$dia2;

if ($anyo==$anyo2){
    if ($mes==$mes2){
        for ($i=$dia; $i<=$dia2; $i++){
            $date=$anyo."-".$mes."-".$i;
            $dianombre=(date('l', strtotime($date)));
            if (strval($dianombre)!="Saturday" and strval($dianombre)!="Sunday"){
                
                array_push($arrdays, intval($i));
            }
            
        }
    }
    else{
        $diferenciameses=$mes2-$mes;
        if ($diferenciameses==1){
            for ($i=0; $i<count($meses31); $i++){

                if ($mes=="1" || $mes=="01" || $mes=="3" || $mes=="03" || $mes=="5" || $mes=="05" || $mes=="7" || $mes=="07"  || $mes=="8" || $mes=="08" || $mes=="10" || $mes=="12"){
                    $max=31;
                }
                else if ($mes==2){
                    if ($anyo%4==0){
                        $max=29;
                    }
                    else{
                        $max=28;
                    }
                }
                else{
                    $max=30;
                }

            }
            for ($i=$dia; $i<=$max; $i++){
                array_push($arrdays, intval($i));
            }

            for ($i=1; $i<=$dia2; $i++){
                array_push($arrdays, intval($i));
            }

        }
        else{

            for($i=$mes; $i<=$mes2; $i++) {
                if($i==$mes){
                    if ($i=="1" || $i=="01" || $i=="3" || $i=="03" || $i=="5" || $i=="05" || $i=="7" || $i=="07"  || $i=="8" || $i=="08" || $i=="10" || $i=="12"){
                        $max=31;
                    }
                    else if ($mes2==2){
                        if ($anyo2%4==0){
                            $max=29;
                        }
                        else{
                            $max=28;
                        }
                    }
                    else{
                        $max=30;
                    }
                    for ($j=$dia; $j<=$max; $j++){
                        array_push($arrdays, intval($j));
                    }

                }
                
                if ($i==$mes2){

                    if ($i=="1" || $i=="01" || $i=="3" || $i=="03" || $i=="5" || $i=="05" || $i=="7" || $i=="07"  || $i=="8" || $i=="08" || $i=="10" || $i=="12"){
                        $max=31;
                    }
                    else if ($mes2==2){
                        if ($anyo2%4==0){
                            $max=29;
                        }
                        else{
                            $max=28;
                        }
                    }
                    else{
                        $max=30;
                    }
                    for ($j=1; $j<=$dia2; $j++){
                        array_push($arrdays, intval($j));
                    }
                }
                if ($i>$mes && $i<$mes2){

                    for ($j=0; $j<count($meses31); $j++){
                        
                        if ($i=="1" || $i=="01" || $i=="3" || $i=="03" || $i=="5" || $i=="05" || $i=="7" || $i=="07"  || $i=="8" || $i=="08" || $i=="10" || $i=="12"){
                            $max=31;
                        }
                        else if ($i==2){
                            if ($anyo%4==0){
                                $max=29;
                            }
                            else{
                                $max=28;
                            }
                        }
                        else{
                            $max=30;
                        }
                    }
                    for ($j=1; $j<=$max; $j++){
                        array_push($arrdays, intval($j));
                    }

                }
            }

        }

    }

}

$tt=((count($arrdays))/2)-1;
$rango_fecha=$arreglo[0]['Fecha']." a ".$arreglo[count($arreglo)-1]['Fecha'];
?>
	<h2 style="text-align:center;">REPORTE DE USUARIOS</h2>

<div style="display:flex;" class="mx-3">
<h4><i class="fa-solid fa-cube" style="margin-left:0px; margin-right:1px; color:red;" ></i>Falta </h4>
<h4><i class="fa-solid fa-cube" style="margin-left:8px; margin-right:1px; color:orange;" ></i>Retardo </h4>
<h4><i class="fa-solid fa-cube" style="margin-left:8px; margin-right:1px; color:#dbdb00;" ></i>Alerta</h4>
</div>
<div class="card">
  <div class="card-body">
  <h3 class="card-title">Resultados de <?php echo $rango_fecha;?>.</h3>
    <div class="col-lg-12">


<button id="btnGen" class="btn btn-outline-primary" onclick="f('Reporte <?php echo $rango_fecha;?>');">Generar PDF</button>
<br>

<table id="example" class="table table-bordered page-break" style="width:100%; padding:10px;">
    <thead>
        <tr>
            <th colspan="31" style="text-align:center;"></th>
        </tr>
        <tr>

            <th colspan="<?php echo $tt;?>">Periodo: <?php echo $arreglo[0]['Fecha'];?></th>
            <th colspan="<?php echo $tt;?>">Periodo: <?php echo $arreglo[count($arreglo)-1]['Fecha'];?></th>

        </tr>
        <tr>
            <?php
            for ($i=0; $i<(count($arrdays)); $i++){

                ?>

                
            <th id="head"><?php echo $arrdays[$i];?></th>
            <?php
            }



            ?>
            <th id="head">FD</th>
            <th id="head">RD</th>
            <th id="head">FN</th>
            <th id="head">RN</th>
            <th id="head"> </th>
        </tr>
    </thead>
    <tbody>

<?php



if ($type==3){
    ini_set('memory_limit', '2700M');
    $new=burbuja($arreglo);
    $total= count($new);
    $arreglo2=[];

    $c=0;
    $save="";
    $arreglo3=[];

    for ($i=0; $i < $total-1; $i++) {
        $pos1=$arreglo[$i]['ID'];
        $pos2=$arreglo[$i]['Fecha'];
        $pos3=$arreglo[$i]['Hora'];
    
        
        $arreglo2=[];
        $conjunto0=$pos1." ".$pos2." ".$pos3;
        array_push($arreglo2,$conjunto0);
        for ($j=1; $j<$total;$j++){
            $pos4=$arreglo[$j]['ID'];
            $pos5=$arreglo[$j]['Fecha'];
            $pos6=$arreglo[$j]['Hora'];
            if ($pos1==$pos4){
                $conjunto=$pos4." ".$pos5." ".$pos6;
                array_push($arreglo2,$conjunto);
                unset($new[$j]);
                $new = array_values($new);
                $new = array_slice($new,0); 
    
            }
    
        }
        $ide=$arreglo2[0][0].$arreglo2[0][1];
        if (is_numeric($ide)){
            $id=$ide;
        }
        else{
            $id=$arreglo2[0][0];
        }
        if (!(in_array($id,$arreglo3))){
            array_push($arreglo3,$id);
            $tot=count($arreglo2);
            ?>
            <?php
            $arrayseparable=[];
            for ($k=0; $k<$tot; $k++){
                $identificador=$arreglo2[$k][0].$arreglo2[$k][1];
                if (is_numeric($identificador)){
                    $iden=$identificador;
                    $fecha_anio=$arreglo2[$k][3].$arreglo2[$k][4].$arreglo2[$k][5].$arreglo2[$k][6];
                    $fecha_mes=$arreglo2[$k][8].$arreglo2[$k][9];
                    $fecha_dia=$arreglo2[$k][11].$arreglo2[$k][12];
                    $hora_h=$arreglo2[$k][14].$arreglo2[$k][15];
                    $hora_m=$arreglo2[$k][17].$arreglo2[$k][18];
                    $hora_s=$arreglo2[$k][20].$arreglo2[$k][21];
                }
    
                if(!(is_numeric($identificador))){
                    $identificador=$arreglo2[$k][0];
                    $iden="0".$identificador;
                    $fecha_anio=$arreglo2[$k][2].$arreglo2[$k][3].$arreglo2[$k][4].$arreglo2[$k][5];
                    $fecha_mes=$arreglo2[$k][7].$arreglo2[$k][8];
                    $fecha_dia=$arreglo2[$k][10].$arreglo2[$k][11];
                    $hora_h=$arreglo2[$k][13].$arreglo2[$k][14];
                    $hora_m=$arreglo2[$k][16].$arreglo2[$k][17];
                    $hora_s=$arreglo2[$k][19].$arreglo2[$k][20];
                }
                $cadena=$iden." ".$fecha_dia." ". $hora_h.":".$hora_m.":".$hora_s." ";
                array_push($arrayseparable,$cadena);
            }
    
            $solovez=0;
            foreach ($arrayseparable as &$val) {
                if ($solovez==0){
                    $identi=$val[0].$val[1];
                    $solovez+=1;
                
                ?>
                <tr class="Empre2" style="background-color: #C8C8C8;">
                    <th>ID</td>
                    <th><?php echo $identi;?></th>
                    <?php
                    for ($h=0; $h<(count($usuarios)); $h++){
                        $Identific=($usuarios[$h]['ID']);
                        if ($identi==$Identific){
                            $nomb=$usuarios[$h]['Nombre'];
                            $Empre=$usuarios[$h]['Empresa'];
                        }}
                    ?>
                        <th colspan="2" style="font-size: larger;"><?php echo $nomb;?></th>
                        <th id="Empre"><?php echo $Empre;?></th>
                    <?php
                    
                    ?>
                <?php
                for ($g=4; $g<(count($arrdays)+4); $g++){
    
                    ?>
                <th></th>
                <?php
                }
                ?>
                
                </tr>
                <?php
                }
            }
            echo "<tr>";
            
            $pasado=$arrayseparable[0][0].$arrayseparable[0][1];
            $FD=0;
            foreach ($arrdays as &$day) { 
                $hora_0="";
                foreach ($arrayseparable as &$valor) { 
                    $dia_0=$valor[3].$valor[4];
                    $hora_1=$valor[6].$valor[7].$valor[8].$valor[9].$valor[10].$valor[11].$valor[12].$valor[13];
                    $hora_2=$valor[6].$valor[7];
                    if ($dia_0==$day){
                        if($hora_0!=""){
                            $hora_0=$hora_0."<br>".$hora_1;
                        }
                        else{
                            $hora_0=$hora_0.$hora_1;
                        }
                    }
                }
                if ($hora_0==""){
                    echo "<td style='background-color:red;color:white;font-size: xx-large;'>F</td>";
                    $FD+=1;
                }
                else{
                    
                    echo "<td id='".$hora_0."'>".$hora_0."</td>";
                }
            }
            echo "<td id='FD".$identi."'>$FD</td>";
            echo "<td id='RD".$identi."'>0</td>";
            echo "<td id='FN".$identi."'>0</td>";
            echo "<td id='RN".$identi."'>0</td>";
            $FD=0;
            echo "</tr>";
        }
    }
}
else if ($type==2){
    ini_set('memory_limit', '2700M');

    $new=burbuja($arreglo);
    $total= count($new);
    $arreglo2=[];

    $c=0;
    $save="";
    $arreglo3=[];

    for ($i=0; $i < $total-1; $i++) {
        $pos1=$arreglo[$i]['ID'];
        $pos2=$arreglo[$i]['Fecha'];
        $pos3=$arreglo[$i]['Hora'];
    
        
        $arreglo2=[];
        $conjunto0=$pos1." ".$pos2." ".$pos3;
        array_push($arreglo2,$conjunto0);
        for ($j=1; $j<$total;$j++){
            $pos4=$arreglo[$j]['ID'];
            $pos5=$arreglo[$j]['Fecha'];
            $pos6=$arreglo[$j]['Hora'];
            if ($pos1==$pos4){
                $conjunto=$pos4." ".$pos5." ".$pos6;
                array_push($arreglo2,$conjunto);
                unset($new[$j]);
                $new = array_values($new);
                $new = array_slice($new,0); 
    
            }
    
        }
        $ide=$arreglo2[0][0].$arreglo2[0][1];
        if (is_numeric($ide)){
            $id=$ide;
        }
        else{
            $id=$arreglo2[0][0];
        }
        if (!(in_array($id,$arreglo3))){
            array_push($arreglo3,$id);
            $tot=count($arreglo2);
            ?>
            <?php
            $arrayseparable=[];
            for ($k=0; $k<$tot; $k++){
                $identificador=$arreglo2[$k][0].$arreglo2[$k][1];
                if (is_numeric($identificador)){
                    $iden=$identificador;
                    $fecha_anio=$arreglo2[$k][3].$arreglo2[$k][4].$arreglo2[$k][5].$arreglo2[$k][6];
                    $fecha_mes=$arreglo2[$k][8].$arreglo2[$k][9];
                    $fecha_dia=$arreglo2[$k][11].$arreglo2[$k][12];
                    $hora_h=$arreglo2[$k][14].$arreglo2[$k][15];
                    $hora_m=$arreglo2[$k][17].$arreglo2[$k][18];
                    $hora_s=$arreglo2[$k][20].$arreglo2[$k][21];
                }
    
                if(!(is_numeric($identificador))){
                    $identificador=$arreglo2[$k][0];
                    $iden="0".$identificador;
                    $fecha_anio=$arreglo2[$k][2].$arreglo2[$k][3].$arreglo2[$k][4].$arreglo2[$k][5];
                    $fecha_mes=$arreglo2[$k][7].$arreglo2[$k][8];
                    $fecha_dia=$arreglo2[$k][10].$arreglo2[$k][11];
                    $hora_h=$arreglo2[$k][13].$arreglo2[$k][14];
                    $hora_m=$arreglo2[$k][16].$arreglo2[$k][17];
                    $hora_s=$arreglo2[$k][19].$arreglo2[$k][20];
                }
                $cadena=$iden." ".$fecha_dia." ". $hora_h.":".$hora_m.":".$hora_s." ";
                array_push($arrayseparable,$cadena);
            }
    
            $solovez=0;
            $sl=0;
            foreach ($arrayseparable as &$val) {
                if ($solovez==0){
                    $identi=$val[0].$val[1];
                    $solovez+=1;
                    for ($h=0; $h<(count($usuarios)); $h++){
                        $Identific=($usuarios[$h]['ID']);
                        if ($identi==$Identific){
                            $nomb=$usuarios[$h]['Nombre'];
                            $Empre=$usuarios[$h]['Empresa'];
                        }}

                if ($Empre=="HyT"){
                    ?>
                <tr class="Empre2" style="background-color: #C8C8C8;">
                    <th>ID</td>
                    <th><?php echo $identi;?></th>
                    <?php
                    for ($h=0; $h<(count($usuarios)); $h++){
                        $Identific=($usuarios[$h]['ID']);
                        if ($identi==$Identific){
                            $nomb=$usuarios[$h]['Nombre'];
                            $Empre=$usuarios[$h]['Empresa'];
                        }}
                    ?>
                        <th colspan="2" style="font-size: larger;"><?php echo $nomb;?></th>
                        <th id="Empre"><?php echo $Empre;?></th>
                    <?php
                    
                    ?>
                <?php
                for ($g=4; $g<(count($arrdays)+4); $g++){
    
                    ?>
                <th></th>
                <?php
                }
                ?>
                
                </tr>
                <?php
                }
                    
                }
                
                

            }
            for ($h=0; $h<(count($usuarios)); $h++){
                $Identific=($usuarios[$h]['ID']);
                if ($identi==$Identific){
                    $nomb=$usuarios[$h]['Nombre'];
                    $Empre=$usuarios[$h]['Empresa'];
                }}

                if ($Empre=="HyT"){

            echo "<tr>";
            
            $pasado=$arrayseparable[0][0].$arrayseparable[0][1];
            $FD=0;
            foreach ($arrdays as &$day) { 
                $hora_0="";
                foreach ($arrayseparable as &$valor) { 
                    $dia_0=$valor[3].$valor[4];
                    $hora_1=$valor[6].$valor[7].$valor[8].$valor[9].$valor[10].$valor[11].$valor[12].$valor[13];
                    $hora_2=$valor[6].$valor[7];
                    if ($dia_0==$day){
                        if($hora_0!=""){
                            $hora_0=$hora_0."<br>".$hora_1;
                        }
                        else{
                            $hora_0=$hora_0.$hora_1;
                        }
                    }
                }
                if ($hora_0==""){
                    echo "<td style='background-color:red;color:white;font-size: xx-large;'>F</td>";
                    $FD+=1;
                }
                else{
                    
                    echo "<td id='".$hora_0."'>".$hora_0."</td>";
                }
            }
            echo "<td id='FD".$identi."'>$FD</td>";
            echo "<td id='RD".$identi."'>0</td>";
            echo "<td id='FN".$identi."'>0</td>";
            echo "<td id='RN".$identi."'>0</td>";
            $FD=0;
            echo "</tr>";
        }}
    }
}


else if ($type==1){
    ini_set('memory_limit', '2700M');

    $new=burbuja($arreglo);
    $total= count($new);
    $arreglo2=[];

    $c=0;
    $save="";
    $arreglo3=[];

    for ($i=0; $i < $total-1; $i++) {
        $pos1=$arreglo[$i]['ID'];
        $pos2=$arreglo[$i]['Fecha'];
        $pos3=$arreglo[$i]['Hora'];
    
        
        $arreglo2=[];
        $conjunto0=$pos1." ".$pos2." ".$pos3;
        array_push($arreglo2,$conjunto0);
        for ($j=1; $j<$total;$j++){
            $pos4=$arreglo[$j]['ID'];
            $pos5=$arreglo[$j]['Fecha'];
            $pos6=$arreglo[$j]['Hora'];
            if ($pos1==$pos4){
                $conjunto=$pos4." ".$pos5." ".$pos6;
                array_push($arreglo2,$conjunto);
                unset($new[$j]);
                $new = array_values($new);
                $new = array_slice($new,0); 
    
            }
    
        }
        $ide=$arreglo2[0][0].$arreglo2[0][1];
        if (is_numeric($ide)){
            $id=$ide;
        }
        else{
            $id=$arreglo2[0][0];
        }
        if (!(in_array($id,$arreglo3))){
            array_push($arreglo3,$id);
            $tot=count($arreglo2);
            ?>
            <?php
            $arrayseparable=[];
            for ($k=0; $k<$tot; $k++){
                $identificador=$arreglo2[$k][0].$arreglo2[$k][1];
                if (is_numeric($identificador)){
                    $iden=$identificador;
                    $fecha_anio=$arreglo2[$k][3].$arreglo2[$k][4].$arreglo2[$k][5].$arreglo2[$k][6];
                    $fecha_mes=$arreglo2[$k][8].$arreglo2[$k][9];
                    $fecha_dia=$arreglo2[$k][11].$arreglo2[$k][12];
                    $hora_h=$arreglo2[$k][14].$arreglo2[$k][15];
                    $hora_m=$arreglo2[$k][17].$arreglo2[$k][18];
                    $hora_s=$arreglo2[$k][20].$arreglo2[$k][21];
                }
    
                if(!(is_numeric($identificador))){
                    $identificador=$arreglo2[$k][0];
                    $iden="0".$identificador;
                    $fecha_anio=$arreglo2[$k][2].$arreglo2[$k][3].$arreglo2[$k][4].$arreglo2[$k][5];
                    $fecha_mes=$arreglo2[$k][7].$arreglo2[$k][8];
                    $fecha_dia=$arreglo2[$k][10].$arreglo2[$k][11];
                    $hora_h=$arreglo2[$k][13].$arreglo2[$k][14];
                    $hora_m=$arreglo2[$k][16].$arreglo2[$k][17];
                    $hora_s=$arreglo2[$k][19].$arreglo2[$k][20];
                }
                $cadena=$iden." ".$fecha_dia." ". $hora_h.":".$hora_m.":".$hora_s." ";
                array_push($arrayseparable,$cadena);
            }
    
            $solovez=0;
            $sl=0;
            foreach ($arrayseparable as &$val) {
                if ($solovez==0){
                    $identi=$val[0].$val[1];
                    $solovez+=1;
                    for ($h=0; $h<(count($usuarios)); $h++){
                        $Identific=($usuarios[$h]['ID']);
                        if ($identi==$Identific){
                            $nomb=$usuarios[$h]['Nombre'];
                            $Empre=$usuarios[$h]['Empresa'];
                        }}

                if ($Empre=="AbaTec"){
                    ?>
                <tr class="Empre2" style="background-color: #C8C8C8;">
                    <th>ID</td>
                    <th><?php echo $identi;?></th>
                    <?php
                    for ($h=0; $h<(count($usuarios)); $h++){
                        $Identific=($usuarios[$h]['ID']);
                        if ($identi==$Identific){
                            $nomb=$usuarios[$h]['Nombre'];
                            $Empre=$usuarios[$h]['Empresa'];
                        }}
                    ?>
                        <th colspan="2" style="font-size: larger;"><?php echo $nomb;?></th>
                        <th id="Empre"><?php echo $Empre;?></th>
                    <?php
                    
                    ?>
                <?php
                for ($g=4; $g<(count($arrdays)+4); $g++){
    
                    ?>
                <th></th>
                <?php
                }
                ?>
                
                </tr>
                <?php
                }
                    
                }
                
                

            }
            for ($h=0; $h<(count($usuarios)); $h++){
                $Identific=($usuarios[$h]['ID']);
                if ($identi==$Identific){
                    $nomb=$usuarios[$h]['Nombre'];
                    $Empre=$usuarios[$h]['Empresa'];
                }}

                if ($Empre=="AbaTec"){

            echo "<tr>";
            
            $pasado=$arrayseparable[0][0].$arrayseparable[0][1];
            $FD=0;
            foreach ($arrdays as &$day) { 
                $hora_0="";
                foreach ($arrayseparable as &$valor) { 
                    $dia_0=$valor[3].$valor[4];
                    $hora_1=$valor[6].$valor[7].$valor[8].$valor[9].$valor[10].$valor[11].$valor[12].$valor[13];
                    $hora_2=$valor[6].$valor[7];
                    if ($dia_0==$day){
                        if($hora_0!=""){
                            $hora_0=$hora_0."<br>".$hora_1;
                        }
                        else{
                            $hora_0=$hora_0.$hora_1;
                        }
                    }
                }
                if ($hora_0==""){
                    echo "<td style='background-color:red;color:white;font-size: xx-large;'>F</td>";
                    $FD+=1;
                }
                else{
                    
                    echo "<td id='".$hora_0."'>".$hora_0."</td>";
                }
            }
            echo "<td id='FD".$identi."'>$FD</td>";
            echo "<td id='RD".$identi."'>0</td>";
            echo "<td id='FN".$identi."'>0</td>";
            echo "<td id='RN".$identi."'>0</td>";
            $FD=0;
            echo "</tr>";
        }}
    }
}
else{
    echo "<th>NO EXISTE INFORMACIÓN</th>";
}







?> 

</tbody>
</table>
<?php
function excelToArray($filePath, $header=true){
    require_once 'PHPExcel/Classes/PHPExcel.php';

    //Create excel reader after determining the file type
    $inputFileName = $filePath;
    /**  Identify the type of $inputFileName  **/
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    /**  Create a new Reader of the type that has been identified  **/
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    /** Set read type to read cell data onl **/
    $objReader->setReadDataOnly(true);
    /**  Load $inputFileName to a PHPExcel Object  **/
    $objPHPExcel = $objReader->load($inputFileName);
    //Get worksheet and built array with first row as header
    $objWorksheet = $objPHPExcel->getActiveSheet();

    //excel with first row header, use header as key
    if($header){
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
        $headingsArray = $headingsArray[1];

        $r = -1;
        $namedDataArray = array();
        for ($row = 2; $row <= $highestRow; ++$row) {
            $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                ++$r;
                foreach($headingsArray as $columnKey => $columnHeading) {
                    $namedDataArray[$r][$columnHeading] = strval($dataRow[$row][$columnKey]);
                }
            }
        }
    }
    else{
        //excel sheet with no header
        $namedDataArray = $objWorksheet->toArray(null,true,true,true);
    }

    return $namedDataArray;
}



function burbuja(&$arreglo)
{
    $longitud = count($arreglo);
    for ($i = 0; $i < $longitud; $i++) {
        for ($j = 0; $j < $longitud - 1; $j++) {
            if ($arreglo[$j] > $arreglo[$j + 1]) {
                $temporal = $arreglo[$j];
                $arreglo[$j] = $arreglo[$j + 1];
                $arreglo[$j + 1] = $temporal;
            }
        }
    }
    return $arreglo;
}
?>



<script>
function GetCellValues() {

        var sTableName = document.getElementById("example");
        for(var i=0;i<sTableName.children[1].childElementCount;i++) 
        {
            $FD=0;
        var tableRow = sTableName.children[1].children[i];
        for(var j=0;j<tableRow.childElementCount;j++)
        {
            var tableColumn = tableRow.children[j].innerHTML;
            var conjunto= tableColumn[j]+tableColumn[j+1];
            if (conjunto!="ID" && tableColumn!=""){
                if (tableColumn.length>8){
                    var tm=tableColumn.length;
                    $time1=tableColumn[0]+tableColumn[1];
                    $time2=tableColumn[3]+tableColumn[4];
                    $time3=tableColumn[6]+tableColumn[7];
                    $time4=tableColumn[tm-8]+tableColumn[tm-7];
                    if ($time1>=09 && $time1<18){
                        $FD=$FD+1;

                        document.getElementById(tableColumn).style.background="red";
                        document.getElementById(tableColumn).style.color="white";
                        document.getElementById(tableColumn).innerHTML+="°";

                        
                    }
                    else if ($time1>=08 && $time2>=41 && $time3>=1){
                        document.getElementById(tableColumn).style.background="orange";
                        document.getElementById(tableColumn).innerHTML+="'";


                    }
                    else if ($time4<18){
                        document.getElementById(tableColumn).style.background="yellow";
                        document.getElementById(tableColumn).innerHTML+="⚠️";

                    }
                }





                

            }  

            
        }
    }
    


    var reg1=GetIDs();
    var reg2=getnum();

    var reg3=getret();

    console.log(reg3);

    for ($i=0; $i<reg1.length; $i++){
        $arm="FD"+reg1[$i];
        $arm2="RD"+reg1[$i];
        $arm3="FN"+reg1[$i];
        $arm4="RN"+reg1[$i];

        $original=document.getElementById($arm).innerHTML;
        $add=parseInt($original)+parseInt(reg2[$i]);
        document.getElementById($arm).innerHTML=$add;

        $original2=document.getElementById($arm2).innerHTML;
        $add2=parseInt($original2)+parseInt(reg3[$i]);
        document.getElementById($arm2).innerHTML=$add2;

        $prefal=document.getElementById($arm).innerHTML;
        $preret=document.getElementById($arm2).innerHTML;
        $finfal=document.getElementById($arm3).innerHTML;
        $finret=document.getElementById($arm4).innerHTML;

        if (parseInt($preret)%3==0){
            $op1=parseInt($preret)/3;
        $op11=$preret-($op1*3);
        $op2=$op11;
        $op3=$op1+parseInt($prefal);

        }
        else{
        $op2=$preret;
        $op3=$prefal;
        }

        document.getElementById($arm4).innerHTML=$op2;
        document.getElementById($arm3).innerHTML=$op3;


    }

}

  


function getnum() {
    list=[];

    $("table > tbody > tr").each(function() {
    var rowText="";
    var rowText2="";
    $(this).find('td').each(function(){
     rowText= rowText +$(this).text() + " ";
    });


    if (rowText!=""){
        let contador = 0;
        let caracter = "°";
        for (let i = 0; i < rowText.length; i++) {
            if (rowText[i] === caracter){
                contador += 1;
            }
        }


                list.push(contador);
        

    }

  });
  return(list);

}

function getret() {
    list=[];

    $("table > tbody > tr").each(function() {
    var rowText="";
    var rowText2="";
    $(this).find('td').each(function(){
     rowText= rowText +$(this).text() + " ";
    });


    if (rowText!=""){
        let contador = 0;
        let caracter = "'";
        for (let i = 0; i < rowText.length; i++) {
            if (rowText[i] === caracter){
                contador += 1;
            }
        }


                list.push(contador);
        

    }

  });
  return(list);

}


function GetIDs(){
    list=[];
    $("table > tbody > tr").each(function() {
    var rowText="";
    $(this).find('th').each(function(){
     rowText= rowText +$(this).text() + " ";
    });
    if (rowText!=""){
        let contador = 0;
        let caracter = "°";
        
        var iden=rowText[20]+rowText[21];
        if (iden!=""){
            if (!(list.includes(iden))){
                list.push(iden);
            }
        
        }


    }
  });
  return(list);

}



function f(name) {
  document.getElementById('btnGen').style.display="none";
    var HTML_Width = $("#example").width();
    var HTML_Height = $("#example").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;
    
    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#example")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 2.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height],true);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage();
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width*4,canvas_image_height*4);
        }
        var compname= name+".pdf";
        pdf.save(compname);
        document.getElementById('btnGen').style.display="initial";
    });
}




</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    

    
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>


<style>
#head {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  z-index: 2;
  background-color: #a8a8a8;
}

#head[scope=row] {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 1;
}

#head[scope=row] {
  vertical-align: top;
  color: inherit;
  background-color: inherit;
  background: linear-gradient(90deg, transparent 0%, transparent calc(100% - .05em), #d6d6d6 calc(100% - .05em), #d6d6d6 100%);
}

table:nth-of-type(2) #head:not([scope=row]):first-child {
  left: 0;
  z-index: 3;
  background: linear-gradient(90deg, #666 0%, #666 calc(100% - .05em), #ccc calc(100% - .05em), #ccc 100%);
}

@media print
{
  .page-break  { display:block; page-break-before:always; }

}


</style>
</body>
</html>