<!DOCTYPE html>
<html>
<head>
	<title>FORMATO DE REPORTE</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mx-4">
  <a class="navbar-brand" href="index.php">Inicio</a>
</nav>
<?php
$data=$_GET['data'];
require_once 'PHPExcel/Classes/PHPExcel.php';
$archivo = $data; #Nombre del excel
$inputFileType = PHPExcel_IOFactory::identify($archivo);
$objReader = PHPExcel_IOFactory::createReader($inputFileType);
$objPHPExcel = $objReader->load($archivo);
$sheet = $objPHPExcel->getSheet(0); #Hoja del excel
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();
for ($rowX = 1; $rowX <= 1; $rowX++){

       $t1=$sheet->getCell("A".$rowX)->getValue();
       $t2=$sheet->getCell("B".$rowX)->getValue();
       $t3=$sheet->getCell("C".$rowX)->getValue();
       $t4=$sheet->getCell("D".$rowX)->getValue();
     }
?>
<div class="content" style="width:97%; margin-left:1%;">
	<h2 style="text-align:center">REPORTE DE SISTEMA ODOO</h2>

    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Resultados del Odoo</h3>
      </div>
      <div class="panel-body">
        <div class="col-lg-12">
            



<table id="example" class="table table-bordered">

      <thead>
      <tr>
        <td>
          <th>Fecha inicial:</th>
          <th><input type="text" id="min" name="min"></th>
          <th>Fecha final:</th>
          <th><input type="text" id="max" name="max"></th>
        </td>
      </tr>
        <tr>
          <th>#</th>
          <th><?php echo $t1;?></th>
          <th><?php echo $t2;?></th>
          <th><?php echo $t3;?></th>
          <th><?php echo $t4;?></th>
        </tr>
      </thead>
      <tbody>


<?php
$num=0;
$max=6;
$list=['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

  for ($row = 2; $row <= $highestRow; $row++){
    $num++;?>
       <tr>
          <th scope='row'><?php echo $num;?></th>
          <?php
          for ($i=0; $i<4; $i++){

            $cell = $sheet->getCell($list[$i].$row);
            $campo= $cell->getValue();
            if(PHPExcel_Shared_Date::isDateTime($cell)) {
                $campo = date($format= "Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($campo)); 
            }
            else{
              $campo=$sheet->getCell($list[$i].$row)->getValue();

            }
            $tamcampo=strlen($campo); 
            if ($campo==""){
              ?>
                <td style="background-color:lightgray;"><?php echo strval($campo);?></td>
              <?php
            }
            else{
              ?>
              <td><?php echo $campo;?></td>
              <?php
            }
            
            
          ?>
          
        
          <?php	
          }
          ?>
        </tr>
          <?php
        }
        ?>

<style>
td:nth-child(2n) {
    border: 1px solid blue;
    width:500px;
    padding: 11px!important;
    word-wrap: break-word;
    
}
td:nth-child(3n),td:nth-child(4n) {
    border: 1px solid blue;
    width:200px;
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
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script type="text/javascript" src="es.js"></script>

<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script>

var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[2] ); 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);



$(document).ready(function() {

  var table = $('#example').DataTable( {
      rowReorder: {
selector: 'td:nth-child(2)'
},


responsive: true,
"language": {
"url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
},
"paging": true,
"processing": true,
'serverMethod': 'post',
dom: 'lBfrtip',
buttons: [
        {
            extend: 'pdf',
            className: 'btn btn-success',
            text: 'PDF página actual',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
        },
        {
            extend: 'pdf',
            className: 'btn btn-primary',
            text: 'PDF todas las paginas',
            exportOptions: {
                modifier: {
                    page: 'all'
                }
            }
        }
    ],
"lengthMenu": [[10, 25, 50,75,100,200, -1], [10, 25, 50,75,100,200, "Todos"]]

} );
table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );


    minDate = new DateTime($('#min'), {

        format: 'MM/DD/YYYY'
    });
    maxDate = new DateTime($('#max'), {
      format: 'MM/DD/YYYY'
    });
 
    // DataTables initialisation
    var table = $('#example').DataTable();
 
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });
} );




</script>


<style>
  .dt-buttons{
    margin-left: 1rem;
  }
</style>
</body>
</html>
