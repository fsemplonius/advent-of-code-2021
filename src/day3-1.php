<?php

include 'day3PuzzleInput.php';

$s2 = explode("\r\n", $s1);
$strlen = strlen($s2[1]);

$row = 0;
$cnt0 = array();
while ($s3=next($s2)) {
  $row++;
  for ($i=0; $i<$strlen; $i++)
    if ($s3[$i] == '0') $cnt0[$i]++;
}

$res0 = $res1 = 0;
for ($i=0; $i<$strlen; $i++) {
  $res0 *= 2;
  $res1 *= 2;
  if ($cnt0[$i] > ($row-$cnt0[$i]))
    $res0++;
  else
    $res1++;
}

echo "result: " . $res0 * $res1;

?>


