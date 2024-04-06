<?php

$data = file_get_contents("php://input");
$arr = file('../info.txt');
$arrInfo = array_pop($arr);

$arrInfo1 = json_decode($arrInfo, true);
$arrAjax = json_decode($data, true);

foreach ($arrInfo1 as $i=>$item) {
    foreach ($arrAjax as $index => $value) {
        if ($item['id'] == $value ['id']) {


            unset($arrInfo1[$i]);

        }

    }
}


$result1=[];


foreach ($arrInfo1 as $item){
    $result1[]=$item;
}
$result2=json_encode($result1,JSON_UNESCAPED_UNICODE);

file_put_contents('../info.txt', $result2);

