<?php

include 'day7PuzzleInput.php';
$poss = $s1;

$minPos = 0;
$maxPos = max($poss);

$dist2fuel = array();
$fuel = 0;
for ($i=0; $i<=$maxPos; $i++)
  $dist2fuel[$i] = $fuel += $i;

$leastFuel = 0;
for ($i=$minPos; $i<=$maxPos; $i++) {
  $fuel = 0;
  for ($j=0; $j<count($poss); $j++)
    $fuel += $dist2fuel[abs($i-$poss[$j])];
  if (!$leastFuel) $leastFuel = $fuel;
  if ($fuel < $leastFuel) {
    $leastFuel = $fuel;
  }
}
    
echo "result: $leastFuel";

?>