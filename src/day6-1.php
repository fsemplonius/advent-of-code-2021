<?php

include 'day6PuzzleInput.php';
array_unshift($s1, 0);
$fish = $s1;
$fish[] = 99;

for ($i=0; $i<80; $i++) {
  $fish_new = array(0);
  $extra = 0;
  while (($s1=next($fish)) <> 99) {
    if (!$s1--) {
      $s1 = 6;
      $extra++;
    }
    $fish_new[] = $s1;
  }
  for ($j=0; $j<$extra; $j++)
    $fish_new[] = 8;
  $fish = $fish_new;
  $fish[] = 99;
}

$result = count($fish) - 2;
echo "result: " . $result;

?>