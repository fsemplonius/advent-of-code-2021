<?php

include 'day12PuzzleInput.php';
$input = explode("\r\n", $s1);

$paths = $starts = $visits = array ();

while ($line=next($input)) {
  $s2 = explode('-', $line);
  if ($s2[$is=0] == 'start' or $s2[$is=1] == 'start')
    $starts[] = $s2[$is?0:1];
  else {
    foreach (array(0, 1) as $i) {
      if ($s2[$i] <> 'end') {
        if (!isset($paths["$s2[$i]"])) {
          $paths[$s2[$i]] = array ('case' => ($s2[$i][0] >= 'a' and $s2[$i][0] <= 'z') ? true: false);		// new entry
          $pathKeys[] = $s2[$i];
        }
        $paths[$s2[$i]]['paths'][] = $s2[$i?0:1];
      }
    }
  }
}

$stack = array();
$routes = 0;
foreach ($starts as $start) {
  $sp = -1;
  $stack[++$sp] = array ($start, 0);
  $stack[++$sp] = array ($paths[$start]['paths'][0], 0);
  while (true) {
    while ($stack[$sp-1][1] + 1 > count($paths[$stack[$sp-1][0]]['paths'])) {
      if ($sp <= 1)
        break 2;
      $sp--;
      $stack[$sp-1][1] += 1;
    }

    $stack[$sp] = array ($paths[$stack[$sp-1][0]]['paths'][$stack[$sp-1][1]], 0);

while (true) {
    if ($stack[$sp][0] == 'end') {
      $routes++;
      $stack[$sp-1][1] += 1;
      //
      // Output found paths
      //
      echo "\nstart,";
      $sep = '';
      for ($i=0; $i<=$sp; $i++) {
        $s11 = $stack[$i][0];
        echo "$sep$s11";
        $sep = ',';
      }
      //
  break;
    }
    if ($paths[$stack[$sp][0]]['case']) {
      $n1 = 0;
      $visits = array_fill_keys($pathKeys, 0);
      for ($j=0; $j<=$sp; $j++) {
        if ($paths[$stack[$j][0]]['case']) {
          $n2 = $visits[$stack[$j][0]] += 1;
          if ($n2 == 2) $n1++;
          if ($n2 > 2 or $n1 >= 2) {
            $stack[$sp-1][1] += 1;
  break 2;
          }
        }
      }
    }
    $stack[++$sp] = array ($paths[$stack[$sp-1][0]]['paths'][0], 0);
  break;
}
  }
}
  
echo "\n\n Result: $routes";

?>