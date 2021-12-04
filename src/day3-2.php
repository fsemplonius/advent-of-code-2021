<?php

include 'day3PuzzleInput.php';

$s21 = $s2 = explode("\r\n", $s1);
$strlen = strlen($s2[1]);

$s21c = array();
$find = '1';
foreach (array('1', '0') as $find) {		// for oxygen and CO2
  for ($i=0; $i<$strlen; $i++) {		// for all bit positions
    $row = $cnt = 0;
    while ($s3=next($s21)) {
      $row++;
      if ($s3[$i] == '1') $cnt++;
    }
    //
    // Copy the lines we need to keep
    //
    $keep = (($cnt < $row-$cnt) xor $find == '0') ? '0' : '1';
    $s21c = array(' ');
    for ($j=0; $j<=$row; $j++) {
      if ($s21[$j][$i] == $keep)
        $s21c[] = $s21[$j];
    }
    $s21 = $s21c;
    if (count($s21) == 2)
      break;
  }
  if ($find) {
    $resO2 = $s21c[1];
    $s21 = $s2;
  }
  else
    $resCO2 = $s21c[1];
}
//
// Convert binary to decimal
//
$resO2d = $resCO2d = 0;
for ($i=0; $i<$strlen; $i++) {
  $resO2d *= 2;
  $resCO2d *= 2;
  if ($resO2[$i]) $resO2d++;
  if ($resCO2[$i]) $resCO2d++;
}

echo "result: " . $resO2d * $resCO2d;

?>