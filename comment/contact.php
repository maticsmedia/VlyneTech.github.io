<?php
session_start();
require_once 'libs/phpmailer/PHPMailerAutoload.php';

$errors =[];

if(isset($_POST['name'],$_POST['message'],$_POST['message'])){
    $fields=[
        'name'=>$_POST['name'],
        'email'=>$_POST['email'],
        'tel'=>$_POST['tel'],
        'message'=>$_POST['message']
        
        

        
	
    ];
    foreach($fields as $field=>$data){
        if(empty($data)){
            $errors[]='The '.$field . ' field is required.';
        }
    }
    if(empty($errors)){
        $m=new PHPMailer;
        $m->isSMTP();
        $m->SMTPAuth=true;
        $m->Host='smtp.gmail.com';
        $m->Username='gray.smithtech@gmail.com';//replace with your email address
        $m->Password='MEAfqp4C96h3SXX';//replace with your password
        $m->SMTPSecure='ssl';
        $m->Port=465;

        $m->isHTML();
        $m->Subject ='Website message';
        $m->Body='From: '.$fields['name'].'<p>Email: '.$fields['email'].'<p>Number: '.$fields['tel'].'<p>Message: '.$fields['message'];

        $m->FromName='MATICS MEDIA';
        $m->AddAddress('maticsmedia@yahoo.com','MATICS MEDIA');
        if ($m->send()) {
            header('Location:thanks.php');
            die();
        }else{
            $errors[]="Sorry ,Could not send email.Try again later.";
        }
    }
}else{
    $errors[]= 'Something went wrong';
}
$_SESSION['errors']=$errors;
$_SESSION['fields']=$fields;
header ('Location:index.php');