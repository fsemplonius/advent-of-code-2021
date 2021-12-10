<?php

include 'day10PuzzleInput.php';
$input = explode("\r\n", $s1);

$close = array('(' => ')', '[' => ']', '{' => '}', '<' => '>');
$points = array ('(' => 1, '[' => 2, '{' => 3, '<' => 4);

$sums = array ();
while ($line=next($input)) {
  $ip = -1;
  $stack = array();
  for ($i=0; $i<strlen($line); $i++) {
    $chr = $line[$i];
    if (in_array ($chr, array('(','[','{','<')))
      $stack[++$ip] = $chr;
    elseif ($ip == -1 or $chr <> $close[$stack[$ip]]) {
      $ip = -1;
      break;
    }
    else
      $ip--;
  }
  if ($ip <> -1) {
    $sum = 0;
    for ($i=$ip; $i>=0; $i--) {
      $sum *= 5;
      $sum += $points[$stack[$i]];
    }
    $sums[] = $sum;
  }
}

sort($sums);
$result = $sums[(count($sums)-1)/2];
echo "result: $result";

?>