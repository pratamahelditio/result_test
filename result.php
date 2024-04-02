<?php
// no 1
$input = array("Knuth-Morris-Pratt", "Mirko-Slavko", "Pasko-Patak");

Foreach($input as $in){
    $inputArray = explode("-",$in);
    $result = "";
    
    Foreach($inputArray as $inp){
    	$result .= substr($inp, 0, 1);
    }

    echo($result . "\n");
}


// no 2
function decrypt($ciphertext, $key) {
  $result = "";
  $ciphertext = strtoupper($ciphertext);
  $key = strtoupper($key); 
  $keyLength = strlen($key);
  $ciphertextLength = strlen($ciphertext);

  for ($i = 0; $i < $ciphertextLength; $i++) {
      $char = $ciphertext[$i];
      $charIdx = ord($char) - ord('A');
      $shift = ord($key[$i % $keyLength]) - ord('A');
      $newCharIdx = ($charIdx - $shift + 26) % 26;
      $result .= chr($newCharIdx + ord('A'));
  }
  
  return $result;
}

$inputCipher = "SGZDOARGYOPWEAE";
$key = "ACM";

$decryptedText = decrypt($inputCipher, $key);
echo "$decryptedText";


// no 3
function checkQuadran($x,$y){
  $result = 0;
  if($x > 0){
      //quadran A / D
      if($y > 0){
          $result = 1;
      } else{
          $result = 4;
      }
  }else{
      //quadran B/C
      if($y > 0){
          $result = 2;
      }else{
          $result = 3;
      }
  }
  
  return $result;
}

$inputX = 10;
$inputY = 6;
echo(checkQuadran($inputX, $inputY) ."\n");

$inputA = 9;
$inputB = -13;
echo(checkQuadran($inputA, $inputB));

// no4
function encoding($text){
  $resultArray = array();
  $beforeChar = "";
  foreach (str_split($text) as $char) {
      if($char == $beforeChar){
          $resultArray[$char] += 1;
          $beforeChar = $char;
      }else{
          $resultArray[$char] = 1;
          $beforeChar = $char;
      }
  }
  
  $result = "";
  foreach($resultArray as $key => $value){
      $result .= $key . $value;
  }
  
  return $result;
}

function decoding($text) {
  $beforeText = "";
  $result = "";
  $counter = 1;
  foreach($text as $tx){
      if($counter == 1){
          $result .= $tx;
          $beforeText = $tx;
          $counter += 1;
      }else {
          for ($i = 0; $i < $tx - 1; $i++) {
              $result .= $beforeText;
          }
          $beforeText = "";
          $counter = 1;
      }
  }
  
  return $result;
}

// belum selesai
echo(encoding("hheell"));
echo(decoding("h2e2l2"));

//no 5 SQL
SELECT 
    m.memid AS id, 
    CONCAT(m.firstname, ' ', m.surname) AS fullname,
    COUNT(b.facid) AS count_bookings,
    (SELECT f.name 
     FROM cd.bookings bo 
     JOIN cd.facilities f ON bo.facid = f.facid
     WHERE bo.memid = m.memid 
     ORDER BY bo.starttime DESC 
     LIMIT 1) AS latest_facilities_name
FROM cd.members m
LEFT JOIN cd.bookings b ON m.memid = b.memid
GROUP BY m.memid, m.firstname, m.surname
ORDER BY m.memid;
