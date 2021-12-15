<?php

include 'day13PuzzleInput.php';
$input = explode("\r\n", $s1);

$xMax = $yMax = 0;
$trParent = array ();
while ($line=next($input)) {
  list ($x, $y) = explode(',', $line);
  $trParent[$x][$y] = '#';
  $xMax = max($x, $xMax);
  $yMax = max($y, $yMax);
}
$foldx = $xMax;
$foldy = $yMax;

while ($line = next($input)) {
  $s2 = explode('fold along ', $line);
  list ($xy, $fold) = explode('=', $s2[1]);
  $in  = $fold + 1;
  $out = $fold - 1;
  if ($xy == 'x') {
    $xin = $in;
    $xout = $out;
    $foldx = $fold;
    for ($x=$fold; $x<=$xMax; $x++) {
      for ($y=0; $y<=$yMax; $y++) {
        if ($trParent[$xin][$y] == '#') {
          $trParent[$xout][$y] = $trParent[$xin][$y];
        }
      }
      $xout--;
      $xin++;
    }
  }
  else {
    $yin = $in;
    $yout = $out;
    $foldy = $fold;
    for ($y=$fold; $y<=$yMax; $y++) {
      for ($x=0; $x<=$xMax; $x++) {
        if ($trParent[$x][$yin] == '#') {
          $trParent[$x][$yout] = $trParent[$x][$yin];
        }
      }
      $yout--;
      $yin++;
    }
  }
}
//
// Display the result
//
for ($y=0; $y<=$foldy; $y++) {
  for ($x=0; $x<=$foldx; $x++) {
    if (!empty($trParent[$x][$y])) {
      $dots++;
      echo '#';
    }
    else
      echo '.';
  }
  echo "\n";
}

?>