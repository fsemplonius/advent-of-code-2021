<?php

include 'day15PuzzleInput.php';
$input = explode("\r\n", $s1);

$xMax = strlen($input[1]);
$yMax = count($input) - 2;

$gtable = $risks = array();
for ($x=0; $x<$xMax*5+2; $x++) {
  $risks[0][$x] = 99;
  for ($y=0; $y<$yMax*5+2; $y++)
    $gtable[$y][$x] = PHP_INT_MAX;
}

for ($i=1; $i<=$yMax; $i++) {
  $risks[$i] = str_split($input[$i]);
  array_unshift($risks[$i], 99);
  for ($j=$xMax+1; $j<=$xMax*5; $j++) {
    if (($risks[$i][$j]=$risks[$i][$j-$xMax]+1) == 10)
      $risks[$i][$j] = 1;
  }
  $risks[$i][$xMax*5+1] = 99;
}

for ($i=$yMax+1; $i<=$yMax*5; $i++) {
  $risks[$i][0] = 99;
  for ($j=1; $j<=$xMax*5; $j++) {
    if (($risks[$i][$j]=$risks[$i-$yMax][$j]+1) == 10)
      $risks[$i][$j] = 1;
  }
  $risks[$i][$xMax*5+1] = 99;
}
$risks[$yMax*5+1] = $risks[0];

$check[] = $current = array (1, 1);
$gtable[1][1] = 0;
$cnt = 0;

while (count($check)) {
  foreach (array(array(0,-1), array(-1,0), array(1,0), array(0,1), array(0,-1)) as $xy) {
    if (($s1=$risks[$current[0]+$xy[0]][$current[1]+$xy[1]]) <> 99) {
      if (($s2=$gtable[$current[0]][$current[1]] + $s1) < $gtable[$current[0]+$xy[0]][$current[1]+$xy[1]]) {
        $gtable[$y=$current[0]+$xy[0]][$x=$current[1]+$xy[1]] = $s2;
        $check[] = array($y, $x);
      }
    }
  }
  $current = array_shift($check);
}

$result = $gtable[$yMax*5][$xMax*5];
echo "Result: $result";

?>