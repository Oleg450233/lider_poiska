<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
$data = file_get_contents("php://input");
$result2=json_decode($data,true);

$name=trim(filter_var($result2['name'],FILTER_SANITIZE_SPECIAL_CHARS));
$tel=trim(filter_var($result2['tel'],FILTER_SANITIZE_SPECIAL_CHARS));
$email=$result2['email'];
$number_order=$result2['number_order'];

$c = array_combine($result2['id'], $result2['counter']);
$z=[];

foreach ($c as $i=>$item){
    $z[]= 'id товара: '.$i.'-> количество товара: '.$item.'<br>';
}


$string=implode(',',$z);
$string1=str_replace(',','',$string);

$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = 0;
    $mail-> isSMTP();
    $mail-> Host = 'ssl://smtp.gmail.com';
    $mail-> SMTPAuth = true;
    $mail->Username = 'nachalnikovk@gmail.com';
    $mail->Password = 'hatb khhc hlbp ilim';
    $mail-> SMTPSecure = 'ssl';
    $mail-> Port = 465;
    $mail->CharSet = 'UTF-8';
    $mail->setFrom('nachalnikovk@gmail.com','Oleg');
    $mail->addAddress($email, $name);
    $mail->addReplyTo('nachalnikovk@gmail.com','Адрес для отправки письма');
     $mail-> isHTML(true);
     $mail-> Subject = 'Тестовое задание,заказ № '. $number_order;
 $mail-> Body =  $name.' заказ №: '.$number_order.' сформирован. В ближайшее время наш специалист свяжется с вами по телефону '.$tel;
 $mail-> AltBody = 'This is the body in plain text for non-HTML mail clients';

 $mail->send();
 echo 'Done';
} catch (Exception  $e) {
    echo 'ОШИБКА';
}
