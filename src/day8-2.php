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

[Part deleted]

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

val 6233
val 4675
val 5572
val 5197
val 8513
val 4356
val 307
val 8507
val 4088
val 3756
val 9295
val 2569
val 5165
val 3061
val 2862
val 1316
val 7879
val 2323
val 2593
val 5720
val 6695
val 7066
val 9013
val 9050
val 4501
val 2886
val 1326
val 734
val 9840
val 8003
val 1752
val 4944
val 2038
val 9216
val 9250
val 4237
val 2145
val 7182
val 1101
val 5063
val 2136
val 8496
val 8523
val 3326
val 4598
val 227
val 6537
val 3390
val 5065
val 9306
val 8460
val 6335
val 2664
val 6446
val 5550
val 4303
val 6955
val 3520
val 9376
val 2586
val 6520
val 2121
val 6685
val 3109
val 2838
val 8257
val 3082
val 7739
val 7132
val 2770
val 5996
val 521
val 3470
val 940
val 2060
val 6396
val 400
val 6050
val 2314
val 8464
val 262
val 9628
val 4719
val 706
val 8307
val 5355
val 4289
val 2422
val 2634
val 714
val 2016
val 2778
val 6695
val 474
val 6970
val 3689
val 3305
val 12
val 5074
val 8060
val 5359
val 9331
val 8993
val 3307
val 9329
val 458
val 9872
val 7089
val 6058
val 5030
val 3634
val 5702
val 3756
val 4506
val 2957
val 8995
val 5657
val 8375
val 415
val 2412
val 3021
val 7241
val 8368
val 9298
val 6666
val 8567
val 2648
val 9621
val 3215
val 5533
val 4972
val 2236
val 8329
val 2582
val 2929
val 2089
val 3436
val 3594
val 1383
val 5555
val 5461
val 2268
val 6377
val 1440
val 9494
val 8314
val 9483
val 3267
val 3037
val 5547
val 9184
val 4900
val 6696
val 7304
val 1294
val 1349
val 8642
val 6126
val 7367
val 5525
val 3861
val 3393
val 2958
val 5312
val 2028
val 5058
val 8513
val 4258
val 1780
val 3937
val 5568
val 6236
val 5159
val 518
val 8059
val 1014
val 1080
val 8538
val 40
val 6722
val 3193
val 2519
val 5877
val 2460
val 3348
val 7329
val 8622
val 4380
val 3629
val 771
val 3734
val 6563
val 1900
val 4502
val 1472
val 6293
val 7392
val 8285
val 9928
val 7535
result: 98?158


?>