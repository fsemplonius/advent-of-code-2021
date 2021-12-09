<?php

include 'day8PuzzleInput.php';
$input = explode("\r\n", $s1);

$cnt = 0;
while ($line=next($input)) {
  $digits = explode(' ', explode(' | ', $line)[1]);
  for ($i=0; $i<4; $i++)
    if (in_array(strlen($digits[$i]), array(2,4,3,7))) $cnt++;
}
   
echo "result: $cnt";

?>