<?php
$data = file_get_contents("php://input");
//$text=fopen('info.txt','a+');
//fwrite($text,$data."\n");
//fclose($text);

file_put_contents('../info.txt',$data);


