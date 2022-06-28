<!DOCTYPE html>
<html>
<head>
	<title>FORMATO DE REPORTE</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">



</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mx-4">
  <a class="navbar-brand" href="index.php">Inicio</a>
</nav>
<?php
$data=$_GET['data'];
$zone=$_GET['zone'];
error_reporting(0);

$usuarios=excelToArray($zone);
require_once 'PHPExcel/Classes/PHPExcel.php';
$archivo = $data; #Nombre del excel
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
try {
  $sheet = $objPHPExcel->getSheet(2); #Hoja del excel
} catch (\Throwable $th) {
  $sheet = $objPHPExcel->getSheet(0); #Hoja del excel
}

$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
$list=['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
for ($rowX = 3; $rowX <= 3; $rowX++){

       $rango_fecha=$sheet->getCell("C".$rowX)->getValue();
     }

     $calc=intval($rango_fecha[21].$rango_fecha[22])-intval($rango_fecha[8].$rango_fecha[9]);
$max=$calc;


?>
<div class="content mt-4" style="width:97%; margin-left:1%;" id="example0">
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
<table class="table table-striped" id="example">
      <thead>
        <tr>
          <th >#</th>
<?php
for ($i=0; $i<=$max; $i++){
  for ($rowX = 4; $rowX <= 4; $rowX++){

    $num=$sheet->getCell($list[$i].$rowX)->getValue();
    echo "<th>".$num."</th>";

  }

}
?>
          <th >FD</th>
          <th >RD</th>
          <th >FN</th>
          <th >RN</th>
        </tr>
      </thead>
      <tbody>


<?php
$num=0;

  for ($row = 5; $row <= $highestRow; $row++){ $num++;?>
       <tr>
          <th  scope='row'><?php echo $num;?></th>
          <?php
                      $FaltasDirectas=0;
                      $retardosTotal=0;
                      $FaltasConversion=0;
                      $retardosrestantes=0;
          for ($i=0; $i<=$max; $i++){

            $campo=$sheet->getCell($list[$i].$row)->getValue();
            $tamcampo=strlen($campo);

            if ($num%2!=0){
              if($i==10){
                for ($x=0; $x<count($usuarios); $x++){
                  if ($usuarios[$x]['ID']==$campo){
                    ?>
                <th  style="background:lightgray; font-size:16px;" colspan="6" ><?php echo $usuarios[$x]['Nombre'];?></th>
                    <?php
                  }
               
                ?>
                <?php
                 }
              }
              if($i==8){
                ?>
                <th  style="background:lightgray; font-size:16px;" colspan="2" ><?php echo $campo;?></th>
                <?php
              }
              elseif($i>=3 && $i<=6){
                ?>
                <th  style="display:none;"><?php echo "";?></th>
                <?php
              }
              elseif($i==10){
                ?>
                <th  style="display:none;"><?php echo "";?></th>
                <?php
              }
              elseif($i>=13 && $i<=$max-4){
                ?>
                <th  style="display:none;"><?php echo "";?></th>
                <?php
              }

              elseif($i==$max-3){
                ?>
                <th  style="background:lightgray; font-size:16px;" colspan="3" ><?php echo $campo;?></th>
                <?php
              }
              elseif($i==$max-1){
                ?>
                <th  style="background:lightgray; font-size:16px;" colspan="2" ><?php echo $campo;?></th>
                <?php
              }
              else{
              ?>
              <th  style="background:lightgray;"><?php echo $campo;?></th>
              <?php
              }
            }
            else{
                  if ($tamcampo==0){
                    $FaltasDirectas=$FaltasDirectas+1;
                    ?>
                    <td style="background:red; color:white;"><?php echo "F";?></td>
                    <?php
                      }
                  if ($tamcampo==5){
                    $retardosTotal=$retardosTotal+1;
                        ?>
                    <td style="background:orange;"><?php echo $campo;?></td>
                    <?php
                      }
                  if ($tamcampo>5){
                    $arr = str_split($campo);
                    
                    $entradaH=$arr[0].$arr[1];
                    $entradaM=$arr[3].$arr[4];
                    if (intval($arr[0])==1){
                      $FaltasDirectas=$FaltasDirectas+1;
                      ?>
                    <td style="background:red; color:white;"><?php echo $campo;?></td>
                    <?php
                    }
                    elseif (intval($arr[1])>8){
                      $FaltasDirectas=$FaltasDirectas+1;
                      ?>
                    <td style="background:red; color:white;"><?php echo $campo;?></td>
                    <?php
                    }
                    elseif (intval($arr[1])>8 && intval($entradaM)>40){
                      $retardosTotal=$retardosTotal+1;
                      ?>
                    <td style="background:orange;"><?php echo $campo;?></td>
                    <?php
                    }
                    #0840+1 retardo, 9+1falta
                    
                    
                    elseif (intval($arr[1])<=8 && intval($arr[$tamcampo-4])>=8 ){
                      ?>
                      <td><?php echo $campo;?></td>
                      <?php
                      }
                      elseif (intval($arr[$tamcampo-4])<8){
                        ?>
                        <td style="background:yellow;"><?php echo $campo;?></td>
                        <?php
                      }
                  }
                }
                
            } 
            $op1=$retardosTotal/3;
            $op2=$op1*3;
            $retardosrestantes=$retardosTotal-$op2;
            $FaltasConversion=$FaltasDirectas+intval($op1);
            ?>
            <td><?php echo $FaltasDirectas;?></td>
            <td><?php echo $retardosTotal;?></td>
            <td><?php echo $FaltasConversion;?></td>
            <td><?php echo $retardosrestantes;?></td>
            <?php
          ?>
          
        </tr>
    	
	<?php	
}
?>

<style>
  table{
    table-layout: fixed;
    width: 100px;
}

th, td {
    width:60px;
    padding: 11px!important;
    word-wrap: break-word;
    
}
</style>


          </tbody>
    </table>
    
  </div>	
 </div>	
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script>


function f(name) {
  document.getElementById('btnGen').style.display="none";
    var HTML_Width = $("#example0").width();
    var HTML_Height = $("#example0").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;
    
    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#example0")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 2.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height],true);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width*4,canvas_image_height*4);
        }
        var compname= name+".pdf";
        
        pdf.save(compname);
        document.getElementById('btnGen').style.display="initial";
    });
}

</script>


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


?>

</body>
</html>
