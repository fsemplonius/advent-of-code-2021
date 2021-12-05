<?php

include 'day5PuzzleInput.php';
$input = explode("\r\n", $s1);

$diagram = array ();
$x2max = $y2max = 0;
while ($line=next($input)) {
  list ($x1, $y1, $x2, $y2) = explode(',', str_replace(' -> ', ',', $line));
  if ($x1 == $x2 or $y1 == $y2) {
    if ($x2 < $x1) [$x1, $x2] = [$x2, $x1];
    if ($y2 < $y1) [$y1, $y2] = [$y2, $y1];
    $x2max = max($x1, $x2, $x2max);
    $y2max = max($y1, $y2, $y2max);
    for ($x=$x1; $x<=$x2; $x++)
      for ($y=$y1; $y<=$y2; $y++)
        $diagram[$x][$y] = empty($diagram[$x][$y]) ? 1: 2;
  }
}

$points = 0;
for ($x=0; $x<=$x2max; $x++)
  for ($y=0; $y<=$y2max; $y++)
    if ($diagram[$x][$y] == 2) $points++;

echo "result: " . $points;

?>