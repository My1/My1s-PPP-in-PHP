<?php
require('bigint.php');

//PPP init values with TEST key

//$phrase="woven.inset.hooks.proud.dk.snake"; //for later testing
//$seed= new Math_BigInteger ("97c8c99b92803426c0a6ae4e9553d24784e45ae3fd3592e896eeb3b4c7e4bd83",16);  //testkey 1
$seed= new Math_BigInteger ("776f76656e2e696e7365742e686f6f6b732e70726f75642e646b2e736e616b65",16);  //testkey 2
//$seed= new Math_BigInteger (bin2hex($phrase),16);


if(isset($_GET["debug"])) {
  $d=true;
  header("Content-Type: text/plain");
}
else{
  $d=false;
}
if($d) {
  echo "Sequence key: ".($seed->toHex())."\n";
}
$set="!#%+23456789:=?@ABCDEFGHJKLMNPRSTUVWXYZabcdefghijkmnopqrstuvwxyz"; //character set
$cols=array("A","B","C","D","E","F","G"); //how should the cols be called and with that, how many sols do we take
$rows=array(1,2,3,4,5,6,7,8,9,10); //how should the rows be called and with that, how many rows do we take
$len=4;  //how many chars per password
$csize=count($cols)*count($rows); //how large is a card
$cardid=0;  //where do we start
$cardamt=3; //how many cards to print

//styling
$ts=16;
if(!$d) {
  $tpl=file_get_contents("ppp.htm");
  $path="";
  $tpl=str_replace("{path}",$path,$tpl);
  $tpl=str_replace("{1}",$ts,$tpl);
  $scard=file_get_contents("pppc.htm");
  $codef="{%002d}";
  for($i=$cardid;$i<$cardid+$cardamt;$i++){
    $card[$i]=$scard;
  }
  $cardb='<tr><td><div class="passcard">';
  $carde='</div></td></tr>';
  $name="testing cards";
}

for(($c=$cardid*$csize);$c<(($cardid+$cardamt)*$csize);$c++) {
  $bic=(new Math_BigInteger($c))->toBytes();
  while (strlen($bic)<(128/8)) {
    $bic="\0".$bic;
  }
  if($d) {
    $carray=str_split($bic);
    echo "counter in decimal bytes: ";
    $ctrdec="";
    foreach ($carray as $cc) {
      $ctrdec.=ord($cc).",";
    }
    echo trim($ctrdec,",");
    echo "\n";
    echo "Encryption result[16]: ".bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $seed->toBytes(),$bic, MCRYPT_MODE_ECB))."\n";
  }
  $init = new Math_BigInteger (bin2hex(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $seed->toBytes(),$bic, MCRYPT_MODE_ECB)),16);
  $pass="";
  for($char=0;$char<$len;$char++) {
    if($char==0) {
      if($d)echo "Encryption result[10]: ";
    }
    else {
      if($d)echo "Quotient: ";
    }
    if($d)echo($init->toString())."\n";
    if($d)echo "Divide by: ".((new Math_BigInteger(strlen($set)))->toString())."\n";
    list($init, $next) = $init->divide(new Math_BigInteger(strlen($set)));
    if($d)echo "Remainder: ".($next->toString())."\n";
    $pass.=$set[$next->toString()];
  }
  $cardnow=floor(($c / $csize))+1;
  $c2=floor($c % $csize)+1; //password number on card
  $rownow=floor($c2 / count($cols));
  $colnow=floor($c2 % count($cols));
  
  
  if($d)
    echo "Password on Card ".$cardnow." Row ".$rows[$rownow]." Col ".$cols[$colnow].": ".$pass."\n-------------------------------------------------------\n";
  else{
    $n="[$cardnow]";
    $sp="";
    for($i=strlen($name.$n);$i<38;$i++){
      $sp.=" ";
    }
    $thisname=$name.$sp.$n;
    $card[$cardnow-1]=str_replace(sprintf($codef,($c2)),$pass,$card[$cardnow-1]);
    $card[$cardnow-1]=str_replace(sprintf($codef,(71)),$thisname,$card[$cardnow-1]);
  }
}
if(!$d) {
  foreach($card as $sc) {
    $tpl=str_replace("<!-- more -->",$cardb.$sc.$carde."<!-- more -->",$tpl);
  }
  echo $tpl;
}
?>