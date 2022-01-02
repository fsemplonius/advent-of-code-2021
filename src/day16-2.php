<?php

include 'day16PuzzleInput.php';

$hex2bin = array('0'=>'0000', '1'=>'0001', '2'=>'0010', '3'=>'0011', '4'=>'0100', '5'=>'0101', '6'=>'0110', '7'=>'0111', 
                 '8'=>'1000', '9'=>'1001', 'A'=>'1010', 'B'=>'1011', 'C'=>'1100', 'D'=>'1101', 'E'=>'1110', 'F'=>'1111');

$bits = '';
foreach (str_split($s1) as $input) {
  $bitstr .= $hex2bin[$input];
}

$bits = str_split($bitstr);
$result = $i = 0;
$val = '';
//
$vers = bin2dec($bits, $i, 3);
$resultv += $vers;
$type = bin2dec($bits, $i, 3);
if ($cnttype = $bits[$i++]) {
  $count = bin2dec($bits, $i, 11);
  $i = 0;
  $result = subpacket_count($bits, $i, $count, $type);
}
else {
  $size = bin2dec($bits, $i, 15);
  $i = 0;
  $result = subpacket_size($bits, $i, $size, $type);
}
//
//
function subpacket_size($bits, &$i, $size, $type) {
  $end = $i + $size;
  $vals = array ();
  while ($i < $end) {
    $vers = bin2dec($bits, $i, 3);
    $resultv += $vers;
    $type1 = bin2dec($bits, $i, 3);
    if ($type1 == 4) {
      $num = 0;
      while ($bits[$i]) {
        $num *= 16;
        $i++;
        $num += bin2dec ($bits, $i, 4);
      }
      $i++;
      $num *= 16;
      $num += bin2dec ($bits, $i, 4);
      $vals[] = $num;
    }
    elseif ($bits[$i]) {
      $i++;
      $count = bin2dec($bits, $i, 11);
      $vals[] = subpacket_count($bits, $i, $count, $type1);
    }
    else {
      $i++;
      $size = bin2dec($bits, $i, 15);
      $vals[] = subpacket_size($bits, $i, $size, $type1);
    }
  }
  return operator($vals, $type);
}
//
//
function subpacket_count($bits, &$i, $count, $type) {
  $vals = array ();
  for ($j=0; $j<$count; $j++) {
    if ($type > 4 && count($vals) >= 2)
      break;
    $vers = bin2dec($bits, $i, 3);
    $resultv += $vers;
    $type1 = bin2dec($bits, $i, 3);
    if ($type1 == 4) {
      $num = 0;
      while ($bits[$i]) {
        $num *= 16;
        $i++;
        $num += bin2dec ($bits, $i, 4);
      }
      $num *= 16;
      $i++;
      $num += bin2dec ($bits, $i, 4);
      $vals[] = $num;
    }
    elseif ($bits[$i]) {
      $i++;
      $count = bin2dec($bits, $i, 11);
      $vals[] = subpacket_count($bits, $i, $count, $type1);
    }
    else {
      $i++;
      $size = bin2dec($bits, $i, 15);
      $vals[] = subpacket_size($bits, $i, $size, $type1);
    }
  }
  return operator($vals, $type);
}
//
//
function operator($vals, $type) {
  $res = 0;
  switch ($type) {
  case 0:
    foreach ($vals as $val)
      $res += $val;
    break;
  case 1:
    $res = $vals[0];
    while ($val=next($vals) or $val === 0)
      $res *= $val;
    break;
  case 2:
    $res = 999999999999;
    foreach ($vals as $val)
      if ($res > $val)
        $res = $val;
    break;
  case 3:
    foreach ($vals as $val)
      if ($res < $val)
        $res = $val;
    break;
  case 5:
    if ($vals[0] > $vals[1]) $res = 1;
    break;
  case 6:
    if ($vals[0] < $vals[1]) $res = 1;
    break;
  case 7:
    if ($vals[0] == $vals[1]) $res = 1;
  }
  return $res;
}
//
//
function bin2dec ($bit, &$ip, $len) {
  $dec = 0;
  for ($i=$ip; $i<$ip+$len; $i++) {
    $dec *= 2;
    $dec += $bit[$i];
  }
  $ip += $len;
  return $dec;
}

echo "Result: $result";

?>