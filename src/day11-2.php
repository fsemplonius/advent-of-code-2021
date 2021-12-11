<?php

include 'day11PuzzleInput.php';
$input = explode("\r\n", $s1);

$xMax = strlen($input[1]);
$s99 = array_fill(0, $xMax+2, 99);

$grid = array ();
$grid[] = $s99;
while ($line=next($input)) {
  $s2 = str_split($line);
  array_unshift ($s2, 99);
  $s2[] = 99;
  $grid[] = $s2;
}
$grid[] = $s99;
$yMax = count($grid) - 2;

$steps = 0;
while (true) {
  $steps++;
  for ($y=1; $y<=$yMax; $y++)
    for ($x=1; $x<=$xMax; $x++)
      $grid[$y][$x] += 1;

  $sw = true;
  while ($sw) {
    $sw = false;
    for ($y=1; $y<=$yMax; $y++)
      for ($x=1; $x<=$xMax; $x++) {
        if (($sc=$grid[$y][$x]) >= 10 and $sc <> 99) {
          $grid[$y][$x] = 99;
          foreach (array(array(-1,-1), array(0,-1), array(1,-1), array(-1,0), array(1,0), array(-1,1), array(0,1), array(1,1)) as $xy)
            if ($grid[$y+$xy[0]][$x+$xy[1]] <> 99) {
              $grid[$y+$xy[0]][$x+$xy[1]] += 1;
              $sw = true;
            }
        }
      }
  }

  $flashes = 0;
  for ($y=1; $y<=$yMax; $y++)
    for ($x=1; $x<=$xMax; $x++)
      if ($grid[$y][$x] >= 10) {
        $flashes++;
        $grid[$y][$x] = 0;
      }
  if ($flashes == 100)
    break;
}

echo "result: $steps";

?>