<?php
require('bigint.php');
header("Content-Type: text/plain");
$ppp="L:k66XiKLeiPMYxf8H!5%%!";
$set="!#%+23456789:=?@ABCDEFGHJKLMNPRSTUVWXYZabcdefghijkmnopqrstuvwxyz"; //character set
//make set and ppp into array
$seta=str_split($set);
$pppa=str_split($ppp);
//get number array
$char=array_pop($pppa);
while($char!==null) {
  $charna[]=array_search($char,$seta);
  $char=array_pop($pppa);
}
//var_dump($charna); //throw the array

$num=new Math_BigInteger(array_shift($charna));
$charn=array_shift($charna);
while($charn!==null) {
  //bla=bla*set
  //bla+next
  //bla+(setxnext)
  echo "prev: ".$num->toString()." Setcount: ".count($seta)." Remainder (from PPP): ".$charn."\n";
  $num=$num->multiply(new Math_BigInteger(count($seta)));
  $num=$num->add(new Math_BigInteger($charn));
  $charn=array_shift($charna);
}
echo "\n\n"."Final Number: ".$num->toString().' Hex: '.$num->toHex();
?>