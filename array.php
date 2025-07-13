<?php
$arr =[1,9,3,7,5,9];
$arr2=array();


print_r($arr);
echo "<br/>";
// $arr[8]=6;
$arr[] = 11; 
echo "<br/>";
print_r($arr);


echo "<br/>";
$arr3=['hello'=>'xin chao'];
print_r($arr3);
echo "<br/>";

echo "<br/>";
$arr3=['buys'=>'mua'];
print_r($arr3);
echo "<br/>";

echo "<br/>";
$arr3=['bye'=>'tam biet'];
print_r($arr3);
echo "<br/>";

foreach($arr as $k=>$a ) {
    // echo "$a<br/>";
    echo "array[$k]=$a<br/>";
}



//sort
print_r($arr);
sort($arr);
echo "<br/>";
print_r($arr);
echo "<br/>";






//get key 
$keys = array_keys($arr3);
echo "<br/>";
print_r($keys);



asort($arr3);
echo "<br/>";
print_r($arr3);


echo "<br/>";
ksort($arr3);
echo "<br/>";   
print_r($arr3);