<?php

/*
$npair =
	1 - [
	2 - 09
	3 - ,
	4 - 09
	4 - ]
	5 - 09 zz present
$numstk uu[xx,yy]zz
$spns =
	3 - 0 => zz 1 => start string 2 => end string when npair = 6
	2 - yy
	1 - xx
	0 - uu
*/

include 'day18PuzzleInput.php';
$inputs = explode("\r\n", $s1);

$result = 0;
foreach ($inputs as $inputA) {
  if (!$inputA) continue;
  foreach ($inputs as $inputB) {
    if (!$inputB or $inputA == $inputB) continue; 
    $result = max($result, calcMagnitude(reduce("[$inputA,$inputB]")));
  }
}

echo "Result: $result";

function reduce ($line) {
  $nonchr = array('[',']',',');
  $sw1 = true;
  while ($sw1) {
    $sw1 = false;
    $nbr = $npair = $ip = 0;
    $spns = -1;
    $numstk = array ();
    //
    // Find pair to explode
    //
    foreach (str_split($line) as $char) {
      if ($npair == 5 and in_array($char, $nonchr))
        break;
      elseif ($char == '[') {
        $lnchr = false;		// last num char
        if ($npair < 4) $npair = 0;
        $nbr++;
      }
      elseif ($char == ']') {
        $lnchr = false;		// last num char
        if ($nbr >= 5 and $npair == 3) {
          $npair = 4;
        }
        elseif ($npair < 4)
          $npair = 0;
        $nbr--;
      }
      elseif ($char == ',') {
        $lnchr = false;		// last num char
      if ($npair == 1) 
          $npair = 2;
        elseif ($npair < 4)
        $npair = 0;
      }
      else {
        if ($lnchr) {
          $numstk[$spns][0] = $numstk[$spns][0]*10 + $char;
          $numstk[$spns][2] = $ip;
        }
        else {
          $numstk[++$spns] = array ($char, $ip, $ip);
          if (in_array($npair, array(0,2,4)))
            $npair++;
        }
        $lnchr = true;		// last num char
      }
      if ($npair == 5 and !$lnchr)
        break;
      $ip++;
    }
    //
    // Explode
    //
    if ($npair >= 4) {
      $sw1 = true;
      if ($npair == 5) $spns--;
      $line1 = substr($line, 0, $numstk[$spns-1][1]-1);
      if ($spns >= 2) {
        $sl = $numstk[$spns-1][0] + $numstk[$spns-2][0];
        $line1 = substr($line, 0, $numstk[$spns-2][1]) . $sl . 
                 substr($line, $n11=$numstk[$spns-2][2]+1, $numstk[$spns-1][1]-$n11-1);
      }
      $line2 = substr($line, $numstk[$spns][2]+2);
      if ($npair == 5) {
        $sr = $numstk[$spns][0] + $numstk[$spns+1][0];
        $line2 = substr($line, $n11=$numstk[$spns][2]+2, $numstk[$spns+1][1]-$n11) . $sr .
                 substr($line, $numstk[$spns+1][2]+1);
      }
      $line = $line1 . "0$line2";
    }
    //
    // Split
    //
    if (!$sw1) {
      for ($i=0; $i<strlen($line)-1; $i++) {
        if (!in_array($line[$i], $nonchr) and !in_array($line[$i+1], $nonchr)) {
          $expl = $line[$i]*10 + $line[$i+1];
          $sw1 = true;
          break;
        }
      }
      if ($sw1) {
        $s1 = floor($expl / 2);
        $s2 = $expl - $s1;
        $line = substr($line, 0, $i) . "[$s1,$s2]" . substr($line, $i+2);
      }
    }
  }
  return $line;
}

function calcMagnitude ($line) {
  /*
  $npair =
	1 - [
	2 - 09
	3 - ,
	4 - 09
	 - ]
  $numstk uu[xx,yy]zz
  */

  $sw1 = true;
  while ($sw1) {
    $sw1 = false;
    $npair = $ip = 0;
    $spns = -1;
    $numstk = array ();
    foreach (str_split($line) as $char) {
      if ($char == '[') {
        $lnchr = false;		// last num char
        $npair = 0;
      }
      elseif ($char == ']') {
        $lnchr = false;		// last num char
        if ($npair == 3) {
          $sw1 = true;
          $sl = 2 * $numstk[$spns][0] + 3 * $numstk[$spns-1][0];
          $line = substr($line, 0, $numstk[$spns-1][1]-1) . $sl .
                  substr($line, $n11=$numstk[$spns][2]+2);
          break;
        }
      }
      elseif ($char == ',') {
        $lnchr = false;		// last num char
        if ($npair == 1) 
          $npair = 2;
        else
          $npair = 0;
      }
      else {
        if ($lnchr) {
          $numstk[$spns][0] = $numstk[$spns][0]*10 + $char;
          $numstk[$spns][2] = $ip;
        }
        else {
          $numstk[++$spns] = array ($char, $ip, $ip);
          if (in_array($npair, array(0,2)))
            $npair++;
        }
        $lnchr = true;		// last num char
      }
      $ip++;
    }
  }
  return $line;
}

?>