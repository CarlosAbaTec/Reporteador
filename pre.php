<?php
$rec=$_GET['doc'];
$name_origin = pathinfo($rec, PATHINFO_FILENAME);
    
    $date = new DateTime();
    $date2= $date->format('YmdHis');
    $renombre="AT-".$name_origin.$date2.$extension;
    echo $renombre;
?>

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
<body onload="exportTableToExcel('tabla', '<?php echo $renombre;?>')">
<table class="table" id="tabla">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Hora</th>
        </tr>
    </thead>
    <tbody>

<?php

$fp = fopen($rec, "r");
while (!feof($fp)){
    $linea = fgets($fp);
    
        $array = explode ( '-', $linea);
    
$cont=0;
foreach ( $array as $palabra ) {
    if ($palabra!=""){
        if ($cont==0){
        
            $cont+=1;
            $idAnio= strval($array[0]);
            $mes= $array[1];
            $dia=$array[2][0].$array[2][1];
            $hora=$array[2][2].$array[2][3].$array[2][4].$array[2][5].$array[2][6].$array[2][7].$array[2][8].$array[2][9].$array[2][10];
            $restID = substr($idAnio, 0, -5);
            $anio= substr($idAnio,-4);
            $fecha=$anio."-".$mes."-".$dia;

            

            ?>

            <tr>
                <td><?php echo $restID;?></td>
                <td><?php echo $fecha;?></td>
                <td><?php echo $hora;?></td>
            </tr>

            <?php
        }
        if ($cont==2){
            $cont=0;
        }
    }

}}
fclose($fp);



?>



    </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    


    <script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }

    window.location.href = "index.php";
}
    </script>
</body>
</html>