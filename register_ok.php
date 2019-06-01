<?php
require("db.php");

$email = $_POST['email'];
$nick = $_POST['nick'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

if(trim($email) == "" || trim($nick) == "" || trim($password) == ""){
    msgAndBack("필수 값이 누락되었습니다.");
    exit;
}

$nick = htmlentities($nick);

if($password != $password2) {
    msgAndBack("비밀번호와 비밀번호 확인이 다릅니다.");
    exit;
}

$sql = "INSERT INTO users(`email`, `nickname`, `password`, `level`)
         VALUES (?, ?, PASSWORD(?), 1)";
$cnt = query($con, $sql, [$email, $nick, $password]);

if($cnt == 1){
    msgAndGo("회원가입 성공","/");
    exit;
}else{
    msgAndBack("회원가입 실패, DB오류");
    exit;
}