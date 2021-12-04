<?php

include 'day4PuzzleInput.php';

$input = explode("\r\n", $s1);
$drawNumbers = explode(',', ' ,'.current($input));
next($input);

$boards = array();
while ($line=next($input)) {
  $board = array();
  $x = 0;
  do {
    $s6 = explode(' ', str_replace('  ',' ',' '.$line));
    for ($i=0; $i<5; $i++)
      $board[$x][] = array (next($s6), false);
    $x++;
  } while ($line=next($input));
  $boards[] = array ($board, false);
}
$boards[] = 99;

while ($draw = next($drawNumbers) or $draw === '0') {
  $i = -1;
  while ($boards[++$i] <> 99) {
    if ($boards[$i][1]) continue;
    for ($x=0; $x<5; $x++)
      for ($y=0; $y<5; $y++) {
        if ($boards[$i][0][$x][$y][0] == $draw) {
          $boards[$i][0][$x][$y][1] = true;
          break 2;
        }
      }
    for ($j=0; $j<5; $j++) {
      if ($boards[$i][0][0][$j][1] && $boards[$i][0][1][$j][1] && $boards[$i][0][2][$j][1] && $boards[$i][0][3][$j][1] && $boards[$i][0][4][$j][1] || 
          $boards[$i][0][$j][0][1] && $boards[$i][0][$j][1][1] && $boards[$i][0][$j][2][1] && $boards[$i][0][$j][3][1] && $boards[$i][0][$j][4][1]) {
        $boards[$i][1] = true;
        $last = $i; $lastDraw = $draw;
        break;
      }
    }
  }
}

$sum = 0;
for ($x=0; $x<5; $x++)
  for ($y=0; $y<5; $y++)
    if (!$boards[$last][0][$x][$y][1]) $sum += $boards[$last][0][$x][$y][0];

echo "result: " . $sum * $lastDraw;

?>