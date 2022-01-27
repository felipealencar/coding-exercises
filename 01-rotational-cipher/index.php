<?php
const ASCII_UPPER_CASE_BOUNDARIES = [65, 91];
const ASCII_LOWER_CASE_BOUNDARIES = [97, 123];


function isAlphabetic($char) {
  return preg_match("/^[a-zA-Z]$/", $char);
}

function isNumeric($char) {
  return preg_match("/^[0-9]$/", $char);
}

function rotationalCipher($input, $rotation_factor) {
  // Write your code here
  $inputSize = strlen($input);
  for($i = 0; $i < $inputSize; $i++) {
    $char = $input[$i];
    $asciiCode = ord($char);
    if(isAlphabetic($char)) {
      $numberOfChars = 26;
      if($asciiCode <= ASCII_UPPER_CASE_BOUNDARIES[1]) {
        $startCode = ord('A');
      } else if($asciiCode >= ASCII_LOWER_CASE_BOUNDARIES[0]){
        $startCode = ord('a');
      }
      $output[$i] = chr((($asciiCode - $startCode + $rotation_factor) % $numberOfChars) + $startCode);
    } else if(isNumeric($char)) {
      $startCode = ord('0');
      $numberOfChars = 10;
      $output[$i] = chr((($asciiCode - $startCode + $rotation_factor) % $numberOfChars) + $startCode);
    } else {
      $output[$i] = $char;
    }
  }
  
  return implode("", $output);
}  


// These are the tests we use to determine if the solution is correct.
// You can add your own at the bottom.

function printString($str) {
  echo "[\"". $str . "\"]";
}

$test_case_number = 1;

function check($expected, $output) {
  global $test_case_number;
  $result = true;
  if ($expected != $output) {
    $result = false;
  }
  $rightTick = '\u2713';
  $wrongTick = '\u2717';
  if ($result) {
    echo json_decode('"'.$rightTick.'"');
    echo " Test # ".$test_case_number ;
    echo "\n";
  }
  else {
    echo json_decode('"'.$wrongTick.'"');
    echo " Test # ".$test_case_number. ": Expected ";
    printString($expected);
    echo " Your Output : ";
    printString($output);
    echo "\n";
  }
  $test_case_number += 1;
}

$input_1 = "All-convoYs-9-be:Alert1.";
$rotation_factor_1 = 4;
$expected_1 = "Epp-gsrzsCw-3-fi:Epivx5.";
$output_1 = rotationalCipher($input_1, $rotation_factor_1);
check($expected_1, $output_1);

$input_2 = "abcdZXYzxy-999.@";
$rotation_factor_2 = 200;
$expected_2 = "stuvRPQrpq-999.@";
$output_2 = rotationalCipher($input_2, $rotation_factor_2);
check($expected_2, $output_2); 
?>