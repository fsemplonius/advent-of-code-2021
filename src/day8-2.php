<?php

include 'day8PuzzleInput.php';
$input = explode("\r\n", $s1);

$display = array ();
$sum = 0;
while ($line=next($input)) {
  $s2 = explode(' ', ($s1=explode(' | ', $line))[0]);
  $digitspl = $digits235 = $digits096 = array ();
  for ($i=0; $i<10; $i++) {
    if (strlen($s2[$i]) == 2)
      $digitspl[1] = str_split($s2[$i]);
    elseif (strlen($s2[$i]) == 3)
      $digitspl[7] = str_split($s2[$i]);
    elseif (strlen($s2[$i]) == 4)
      $digitspl[4] = str_split($s2[$i]);
    elseif (strlen($s2[$i]) == 7)
      $digitspl[8] = str_split($s2[$i]);
    elseif (strlen($s2[$i]) == 5)
      $digits235[] = array ($s2[$i], str_split($s2[$i]));
    elseif (strlen($s2[$i]) == 6)
      $digits096[] = array ($s2[$i], str_split($s2[$i]));
  }
  for ($i=0; $i<3; $i++) {
    if ((count(array_diff($digits235[$i][1], $digitspl[1]))) == 3) {
      $digitspl[3] = $digits235[$is=$i][1];
      break;
    }
  }
  $sege = array_diff($all_segments=array('a','b','c','d','e','f','g'), $digitspl[3], $digitspl[4]);
  $segb = array_diff($all_segments, $digitspl[3], $sege);
  for ($i=0; $i<3; $i++) {
    if ($i <> $is) {
      if (count(array_diff($digits235[$i][1], $digitspl[3], $sege)))
        $digitspl[5] = $digits235[$i][1];
      else
        $digitspl[2] = $digits235[$i][1];
    }
  }
  for ($i=0; $i<3; $i++) {
    if (($n=count(array_diff($digits096[$i][1], $sege))) == 6) {
      $digitspl[9] = $digits096[$is=$i][1];
      break;
    }
  }
  for ($i=0; $i<3; $i++) {
    if ($i <> $is) {
      if (($n=count(array_diff($digits096[$i][1], $digitspl[7]))) == 3)
        $digitspl[0] = $digits096[$i][1];
      else
        $digitspl[6] = $digits096[$i][1];
    }
  }
  $s2 = explode(' ', $s1[1]);
  $val = 0;
  for ($i=0; $i<4; $i++) {
    $display = str_split($s2[$i]);
    $val *= 10;
    for ($j=0; $j<10; $j++) {
      if (count($display) == count($digitspl[$j]) && 
          array_diff($display, $digitspl[$j]) === array_diff($digitspl[$j], $display))
        $val += $j;
    }
  }
echo "val $val\n";
  $sum += $val;
}
  
echo "result: $sum";

?>