<?php

include 'day6PuzzleInput.php';

array_unshift($s1, 0);
$fish = $s1;
$fish[] = 99;

$fish_num = array_fill (0, 8, 0);
while (($s1=next($fish)) <> 99)
  $fish_num[$s1]++;

$arrShift = array_fill(0, 3, 0);
$index = 0;
for ($i=0; $i<256; $i++) {
  if ($index++ == 7) $index = 1;
  $arrShift[2] = $fish_num[$index];
  $fish_num[$index] += array_shift($arrShift);
}

$result = array_sum($fish_num) + $arrShift[0];
echo "result: " . $result;

?>