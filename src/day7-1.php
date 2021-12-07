<?php

include 'day7PuzzleInput.php';
$poss = $s1;

$minPos = min($poss);
$maxPos = max($poss);
$leastFuel = array_sum($poss);
for ($i=$minPos; $i<=$maxPos; $i++) {
  $fuel = 0;
  for ($j=0; $j<count($poss); $j++)
    $fuel += abs($i - $poss[$j]);
  if ($fuel < $leastFuel)
    $leastFuel = $fuel;
}
    
echo "result: $leastFuel";

?>