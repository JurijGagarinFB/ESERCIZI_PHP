<?php

#DataTime()
$data = new DateTime();
echo "Data di oggi: " . $data->format("d/m/Y");
echo "<br>";
echo "Ora di oggi: " . $data->format("H:i:s");
echo "<br>";
echo "Data e Ora di oggi: " . $data->format("d/m/Y H:i:s");

$data->modify("+2 days");
echo "<br>";
echo "Data fra 2 giorni: " . $data->format("d/m/Y");

$data2 = new DateTime("+10 months");
echo "<br>";
echo "Data fra 10 mesi: " . $data2->format("d/m/Y");

echo "<br>";
echo "<br>";

#differenza tra due date
$d1 = new DateTime("2025/01/01 12:20:30");
$d2 = new DateTime("2002/07/10 08:32:21");

echo "Differenza tra due date: ";
$diff = $d1->diff($d2);

echo $diff->days;
echo "<br>";
echo $diff->m;
echo "<br>";
echo $diff->y;
echo "<br>";
echo $diff->format("%y %m %d %H:%i:%s");
echo "<br>";
echo $diff->format("%d");

echo "<br>";
echo "<br>";

$intervaltime = new DateInterval("P1Y3M4DT2H3M4S");
$newdate = $d1->add($intervaltime);
echo $newdate->format("d/m/y H:i:s");

echo "<br>";
echo "<hr>";
echo "<br>";

#-----------------------------------------------------------------------------------------------------------------------