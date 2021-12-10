<?php

include 'day10PuzzleInput.php';
$input = explode("\r\n", $s1);

$close = array('(' => ')', '[' => ']', '{' => '}', '<' => '>');
$points = array (')' => 3, ']' => 57, '}' => 1197, '>' => 25137);

$sum = 0;
while ($line=next($input)) {
  $ip = -1;
  $stack = array();
  for ($i=0; $i<strlen($line); $i++) {
    $chr = $line[$i];
    if (in_array ($chr, array('(','[','{','<')))
      $stack[++$ip] = $chr;
    elseif ($ip == -1 or $chr <> $close[$stack[$ip]]) {
      $sum += $points[$chr];
      break;
    }
    else
      $ip--;
  }
}

echo "result: $sum";

?>