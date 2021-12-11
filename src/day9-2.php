<?php

include 'day9PuzzleInput.php';
$input = explode("\r\n", $s1);

$xMax = strlen($input[1]);
for ($i=0; $i<$xMax; $i++)
  $s2 .= '9';
array_unshift ($input, 0, $s2);
$input[] = $s2;
$input[] = 0;

$basin = array();
while ($s3=next($input))
  $basin[] = "9$s3".'9';
$yMax = count($basin) - 2;

$sizes = array(0);
for ($y=1; $y<=$yMax; $y++) {
  for ($x=1; $x<=$xMax; $x++) {
    if ($basin[$y][$x] < min($basin[$y-1][$x], $basin[$y+1][$x], $basin[$y][$x-1], $basin[$y][$x+1])) {
      $map = array ();
      $ip = -1;
      $map[0] = array ($y, $x);
      while (++$ip < count($map)) {
        list ($y1, $x1) = $map[$ip];
        if ($basin[$y1][$x1] == '9') continue;
        foreach (array(array(0,-1), array(-1,0), array(1,0), array(0,1)) as $xy) {
          if ($basin[$y1+$xy[0]][$x1+$xy[1]] <> '9' and !in_array(array ($y1+$xy[0], $x1+$xy[1]), $map)) {
            $map[] = array ($y1+$xy[0], $x1+$xy[1]);
          }
        }
      }
      $sizes[] = count($map);
    }
  }
}

rsort($sizes);
$result = $sizes[0] * $sizes[1] * $sizes[2];
echo "result: $result";

?>