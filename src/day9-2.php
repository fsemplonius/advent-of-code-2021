<?php

// This solution only produces the right answer for the test set not for the full set

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

$map = array ();
$id = 1;
for ($y=1; $y<=$yMax; $y++)
  for ($x=1; $x<=$xMax; $x++) {
    if ($basin[$y][$x] < min($basin[$y-1][$x], $basin[$y+1][$x], $basin[$y][$x-1], $basin[$y][$x+1])) {
      $map[$y][$x] = array (2, $id++);
    }
  }
$idMax = $id-1;		// number of ids used

$found = false;
while(!$found) {
  $found = true;
  for ($y=1; $y<=$yMax; $y++)
    for ($x=1; $x<=$xMax; $x++) {
      if ($map[$y][$x][0] == 2) {
        $id = $map[$y][$x][1];
        foreach (array(array(-1,-1),array(0,-1),array(1,-1),array(-1,0),array(1,0),array(-1,1),array(0,1),array(1,1)) as $xy) {
          if ($basin[$y+$xy[0]][$x+$xy[1]] <> '9' and 
             ($basin[$y][$x] + 1 == $basin[$y+$xy[0]][$x+$xy[1]])) {
            $map[$y+$xy[0]][$x+$xy[1]] = array (1, $id);
            $found = false;
          }
        }
      }
    }
  if ($found) break;
  for ($y=1; $y<=$yMax; $y++)
    for ($x=1; $x<=$xMax; $x++)
      if (!empty($map[$y][$x])) $map[$y][$x][0] += 1;
}

$bsize = array_fill(1, $idMax, 0);
for ($y=1; $y<=$yMax; $y++)
  for ($x=1; $x<=$xMax; $x++)
    if (!empty($map[$y][$x])) $bsize[$map[$y][$x][1]]++;

arsort($bsize);
$result = current($bsize) * next($bsize) * next($bsize);

echo "result: $result";

?>