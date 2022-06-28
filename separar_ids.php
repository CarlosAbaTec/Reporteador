<?php
//ordenamos el arreglo
$new=$arreglo;
sort($new);
// obtenemos el tamaño
$total= count($new);
// creamos un arreglo con los distintos IDs para crear subarreglos
$ids=[];
for ($i=0; $i < $total; $i++) { 
    if(in_array($new['ID'], $new)){
        $ids[]=$new['ID'];
    }
}
// creamos un array de arrays
$separateds=[];
foreach ($ids as &$id) {
    //por cada id buscamos todos los elementos que tengan ese id y lo borramos del arreglo
    $uniques=[];
    for ($j=0; $j < count($new); $j++) { 
        if($new[$j]['ID']==$id){
            $uniques[]=$new[$j]['ID'];
            unset($new[$j]);
        }
    }
    // mapeamos en el nuevo arreglo
    $separateds[]=array($id=>$uniques);
}
?>