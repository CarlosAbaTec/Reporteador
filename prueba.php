<?php



$date1 = new DateTime("2015-02-14");
$date2 = new DateTime("2015-02-16");
$diff = $date1->diff($date2);

echo $diff->d." Meses";


?>