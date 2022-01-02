<?php

/*
8A004A801A8002F478:
100010100000000001001010100000000001101010000000000000101111010001111000
VVVTTTILLLLLLLLLLLVVVTTTILLLLLLLLLLLVVVTTTILLLLLLLLLLLLLLLVVVTTTAAAAA
620080001611562C8802118E34:
01100010000000001000000000000000000101100001000101010110001011001000100000000010000100011000111000110100
VVVTTTILLLLLLLLLLLVVVTTTILLLLLLLLLLLLLLLVVVTTTAAAAAVVVTTTAAAAAVVVTTTILLLLLLLLLLLVVVTTTAAAAAVVVTTTAAAAA
C0015000016115A2E0802F182340:
1100000000000001010100000000000000000001011000010001010110100010111000001000000000101111000110000010001101000000
VVVTTTILLLLLLLLLLLLLLLVVVTTTILLLLLLLLLLLLLLLVVVTTTAAAAAVVVTTTAAAAAVVVTTTILLLLLLLLLLLVVVTTTAAAAAVVVTTTAAAAA
*/

include 'day16PuzzleInput.php';

$hex2bin = array('0'=>'0000', '1'=>'0001', '2'=>'0010', '3'=>'0011', '4'=>'0100', '5'=>'0101', '6'=>'0110', '7'=>'0111', 
                 '8'=>'1000', '9'=>'1001', 'A'=>'1010', 'B'=>'1011', 'C'=>'1100', 'D'=>'1101', 'E'=>'1110', 'F'=>'1111');

$bits = '';
foreach (str_split($s1) as $input) {
  $bits .= $hex2bin[$input];
}

$bitarr = str_split($bits);
$result = $i = 0;

while ($i+6 < count($bitarr)) {
  $vers = bin2hexa($bitarr, $i, 3);
  $result += $vers;
  $i += 3;
  $type = bin2hexa($bitarr, $i, 3);
  $i += 3;
  if ($type == 4) {	// literal?
    while ($bitarr[$i])
      $i += 5;
    $i += 5;
  }
  else
    $i += $bitarr[$i] ? 12: 16;
}

function bin2hexa ($bit, $ip, $len) {
  $dec = 0;
  for ($i=$ip; $i<$ip+$len; $i++) {
    $dec *= 2;
    $dec += $bit[$i];
  }
  return $dec;
}

echo "Result: $result";

?>