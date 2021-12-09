<?php

include 'day9PuzzleInput.php';
$input = explode("\r\n", $s1);

$strlen = strlen($input[1]);
for ($i=0; $i<$strlen; $i++)
  $s2 .= '9';
array_unshift ($input, 0, $s2);
$input[] = $s2;
$input[] = 0;

$skip = 1;
$sum = 0;
while ($s3=next($input)) {
  $line2 = $line1;
  $line1 = $line0;
  $line0 = "9$s3".'9';
  if ($skip-- < 0) {
    for ($i=1; $i<=$strlen; $i++) {
      if ($line1[$i] < min($line1[$i-1], $line1[$i+1], $line0[$i], $line2[$i])) {
        $sum += $line1[$i] + 1;
      }
    }
  }
}

echo "result: $sum";

?>