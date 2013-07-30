<?php //echo date('F'); 
$month = strtolower(date("F", strtotime("-1 month"))); 
echo $month; ?>