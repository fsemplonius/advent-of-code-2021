<?php

include 'day15PuzzleInput.php';
$input = explode("\r\n", $s1);

$xMax = strlen($input[1]);
$gtable = $risks = array();
for ($i=0; $i<$xMax+2; $i++) {
  $gtable[0][$i] = PHP_INT_MAX;
  $risks[0][$i] = 99;
}

for ($i=1; $i<$xMax+1; $i++) {
  $risks[$i] = str_split($input[$i]);
  array_unshift ($risks[$i], 99);
  $risks[$i][] = 99;
  $gtable[$i] = $gtable[0];
}
$risks[] = $risks[0];
$gtable[] = $gtable[0];
$yMax = count($gtable) - 2;

$check[] = $current = array (1, 1);
$gtable[1][1] = 0;

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

$result = $gtable[$yMax][$xMax];
echo "Result: $result";

?>